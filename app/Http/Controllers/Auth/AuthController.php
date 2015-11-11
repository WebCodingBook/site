<?php

namespace WebCoding\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use WebCoding\Models\User;
use Validator;
use WebCoding\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/';
    protected $loginPath = '/signin';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getSignOut']);
    }

    /**
     * Page d'inscription
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSignup()
    {
        return view('auth.signup');
    }

    /**
     *  Traitement de l'inscription
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email'         =>  'required|unique:users|email|max:255',
            'username'      =>  'required|unique:users|alpha_dash|min:4|max:60',
            'password'      =>  'required|min:8|confirmed',
        ]);

        User::create([
            'email'     =>  $request->input('email'),
            'username'  =>  $request->input('username'),
            'password'  =>  bcrypt($request->input('password')),
        ]);

        alert()->success('Félicitations !', 'Vous voilà maintenant inscrit');
        return redirect()->route('front.index');
    }

    /**
     * Page de connexion
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSignin()
    {
        return view('auth.signin');
    }

    /**
     * Traitement de la connexion
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'email'     =>  'required|email',
            'password'  =>  'required',
        ]);

        //  En cas d'échec de connexion
        if( !Auth::attempt($request->only(['email', 'password']), $request->has('remember')) ) {
            alert()->error('Vos identifiants ne correspondent pas');
            return redirect()->back();
        }
        
        alert()->success('Vous voilà maintenant connecté !');
        return redirect()->route('front.index');
    }

    /**
     * Déconnexion
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getSignOut()
    {
        Auth::logout();
        alert()->success('Vous voilà maintenant déconnecté');
        return redirect()->route('front.index');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
