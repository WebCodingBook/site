<?php

namespace WebCoding\Http\Controllers\Users;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Auth;
use WebCoding\Http\Requests;
use WebCoding\Http\Controllers\Controller;
use WebCoding\Models\Activity;
use WebCoding\Models\User;
use WebCoding\Services\ImageService;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Profil public d'un utilisateur
     *
     * @param $username
     * @return $this|ModelNotFoundException
     */
    public function profile($username)
    {
        $user = User::where('username', $username)->first();
        if( !$user ) {
            return new ModelNotFoundException('Cet utilisateur n\'exite pas');
        }
        $activities = Activity::with('user', 'comments', 'likes')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('users.user_view', compact('user', 'activities'));
    }

    /**
     * Retourne les amis d'un utilisateur
     *
     * @param $username
     * @return $this|ModelNotFoundException
     */
    public function friends($username)
    {
        $user = User::where('username', $username)->first();
        if( !$user ) {
            return new ModelNotFoundException('Cet utilisateur n\'exite pas');
        }
        return view('users.user_friends')->with('user', $user);
    }

    /**
     * Edition du compte
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editAccount()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('profile.user_account', compact('user'));
    }

    /**
     * Mise à jour du compte
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAccount(Request $request)
    {
        if( $request->input('user_id') != Auth::user()->id ) {
            abort(404);
        }

        $this->validate($request, [
            'email'     =>  'required|email|unique:users,id,' . Auth::user()->id,
            'firstname' =>  'alpha|min:2|max:60',
            'lastname'  =>  'alpha|min:3|max:60'
        ]);

        Auth::user()->update([
            'email'     =>  $request->input('email'),
            'firstname' =>  $request->input('firstname'),
            'lastname'  =>  $request->input('lastname')
        ]);

        alert()->success('Votre compte a correctement été mis à jour');
        return redirect()->route('profile.edit');
    }

    /**
     * Edition du mot de passe
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPassword()
    {
        return view('profile.user_password');
    }

    /**
     * Mise à jour du mot de passe
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        if( $request->input('user_id') != Auth::user()->id ) {
            abort(404);
        }

        if( !empty($request->input('password')) ) {
            $this->validate($request, [
                'password'  =>  'required|confirmed|min:8'
            ]);

            Auth::user()->update([
                'password'  =>  bcrypt($request->input('password'))
            ]);
        }

        alert()->success('Votre mot de passe a correctement été mis à jour');
        return redirect()->route('profile.edit');
    }

    /**
     * Edition des informations
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editInfos()
    {
        return view('profile.user_infos');
    }

    /**
     * Mise à jour des informations
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfos(Request $request)
    {
        if( $request->input('user_id') != Auth::user()->id ) {
            abort(404);
        }

        $this->validate($request, [
            'country'       =>  'max:50',
            'department'    =>  'max:60',
            'city'          =>  'max:60',
            'job'           =>  'max:60',
            'birthday'      =>  'date_format:d/m/Y',
        ]);

        Auth::user()->update([
            'country'       =>  $request->input('country'),
            'department'    =>  $request->input('department'),
            'city'          =>  $request->input('city'),
            'job'           =>  $request->input('job'),
            'birthday'      =>  $request->input('birthday')
        ]);

        alert()->success('Vos informations ont été mises à jour !');
        return redirect()->route('profile.edit');
    }

    /**
     * Edition de la couverture
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPerso()
    {
        $cover = Auth::user()->cover;
        return view('profile.user_perso')->with('cover', $cover);
    }

    /**
     * Mise à jour de la personnalisation
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePerso(Request $request)
    {
        if( $request->input('user_id') != Auth::user()->id ) {
            abort(404);
        }

        $this->validate($request, [
            'cover'     =>  'mimes:jpg,jpeg,png|max:2000'
        ]);

        //  On supprime la couverture
        if( $request->hasFIle('cover') && $request->file('cover')->isValid() ) {

            $coverPath = public_path() . '/uploads/users/covers';
            $cover = new ImageService($coverPath);
            $cover->delete(Auth::user()->cover, ['full', 'mini', 'thumb']);
            $cover->prepare($request->file('cover'), Auth::user()->username . '-cover');
            $cover->resize('150', 150, 'thumb');

            $saveCover = $cover->getFile(0);

            Auth::user()->update([
                'cover'    =>  $saveCover['name'],
            ]);
        }

        alert()->success('Vos informations ont été mises à jour !');
        return redirect()->route('profile.edit');
    }

    public function editSkills()
    {
        return view('profile.user_skills');
    }

    public function updateSkill(Request $request)
    {
        $this->validate($request, [
            'skills'    =>  'array',
        ]);

        foreach( $request->input('skills') as $skill ) {

        }
    }

    public function editCV()
    {

    }

    public function updateCV()
    {

    }

    public function delete()
    {

    }

    public function destroy()
    {

    }
}
