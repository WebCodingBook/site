<?php

namespace WebCoding\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use WebCoding\Http\Requests;
use WebCoding\Http\Controllers\Controller;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * @param $user_id
     * @param $friend_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($user_id, $friend_id)
    {
        alert()->success('L\'utilisateur ne fait plus parti de vos contacts');
        return redirect()->route('front.index');
    }
}
