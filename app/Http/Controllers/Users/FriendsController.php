<?php

namespace WebCoding\Http\Controllers\Users;

use Auth;
use WebCoding\Models\User;
use Illuminate\Http\Request;

use WebCoding\Http\Requests;
use WebCoding\Http\Controllers\Controller;
use WebCoding\Repositories\UserRepository;

class FriendsController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Affiche la liste des amis et des demandes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view('friends.index', compact('friends', 'requests'));
    }

    /**
     * Demande d'ajout comme contact
     *
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($username)
    {
        $user = User::where('username', $username)->first();
        if( !$user ) {
            alert()->error('Cet utilisateur n\'existe pas');
            return redirect()->route('front.index');
        }

        //  Pas de demande à soi même...
        if( Auth::user()->id === $user->id ) {
            alert()->warning('Vous ne pouvez pas vous faire de demande de contact', 'Soyons sérieux :)')->autoclose(5000);
            return redirect()->route('user.view', ['username' => $user->username]);
        }

        //  On vérifie que l'utilisateur n'est pas en attente
        // d'acceptation ou n'a pas fait de demande
        if( Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()) ) {
            alert()->warning('Une demande de contact est déjà en cours');
            return redirect()->route('user.view', ['username' => $user->username]);
        }

        //  On vérifie que les utilisateurs ne sont pas déjà "amis"
        if( Auth::user()->isFriendWith($user) ) {
            alert()->warning($user->full_name . ' fait déjà parti de vos contacts');
            return redirect()->route('user.view', ['username' => $user->username]);
        }

        /*
         * TODO: Système de notification pour prévenir l'autre utilisateur d'une demande
         * TODO: Ajaxer la demande
         */

        Auth::user()->addFriend($user);
        alert()->success('La demande de contact a été transmise à ' . $user->full_name, 'Demande envoyée !');
        return redirect()->route('user.view', ['username' => $user->username]);
    }

    /**
     * Permet d'accepter une demande de contact
     *
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept($username)
    {
        $user = User::where('username', $username)->first();

        //  On vérifie que le membre courant a bien une demande
        if( !Auth::user()->hasFriendRequestReceived($user) ) {
            alert()->warning('Vous n\'avez aucune demande de ce contact');
            return redirect()->route('user.view', ['username' => $user->username]);
        }

        Auth::user()->acceptFriendRequest($user);
        alert()->success($user->full_name . ' fait maintenant parti de vos contacts', 'Demande acceptée !');
        return redirect()->route('user.view', ['username' => $user->username]);
    }

    /**
     * Permet de supprimer un membre de ses contacts
     *
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($username)
    {
        $user = User::where('username', $username)->first();
        if( !$user ) {
            alert()->error('Cet utilisateur n\'existe pas');
            return redirect()->route('front.index');
        }

        alert()->success($user->full_name . ' ne fait plus parti de vos contacts');
        return redirect()->route('front.index');
    }
}
