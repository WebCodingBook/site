<?php

namespace WebCoding\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use WebCoding\Http\Requests;
use WebCoding\Http\Controllers\Controller;
use WebCoding\Models\User;

class SearchController extends Controller
{
    /**
     * Recherche un utilisateur
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function usersResults(Request $request)
    {
        $query = $request->input('search_user');
        if( !$query ) {
            return redirect()->route('front.index');
        }

        $users = User::where(DB::raw("CONCAT(firstname, ' ', lastname)"), 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")
            ->paginate(15);

        return view('search.users_results', ['u' => $users]);
    }
}
