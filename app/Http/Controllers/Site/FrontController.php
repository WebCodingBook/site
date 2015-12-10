<?php

namespace WebCoding\Http\Controllers\Site;

use Auth;
use Illuminate\Http\Request;
use WebCoding\Http\Requests;
use WebCoding\Http\Controllers\Controller;
use WebCoding\Models\Activity;

class FrontController extends Controller
{

    /**
     * Retourne la liste des dernières activités ou la page d'accueil
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if( Auth::check() ) {
            $activities = Activity::with('user', 'comments', 'likes')
                ->where(function($query) {
                    return $query->where('user_id', Auth::user()->id)
                        ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
                })
                ->latest()
                ->paginate(10);

            return view('timeline.index', compact('activities'));
        }
        return view('pages.front');
    }

    public function contact()
    {

    }

}
