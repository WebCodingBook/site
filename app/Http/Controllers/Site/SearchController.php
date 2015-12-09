<?php

namespace WebCoding\Http\Controllers\Site;

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
    public function users(Request $request)
    {
        if( $request->isMethod('post') ) {
            $query = $request->input('search_user');
            $users = User::where(DB::raw("CONCAT(firstname, ' ', lastname)"), 'LIKE', "%{$query}%")
                ->orWhere('username', 'LIKE', "%{$query}%")
                ->paginate(15);
        } else {
            $users = [];
        }

        return view('search.users_results', ['users' => $users]);
    }
}
