<?php

namespace WebCoding\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use WebCoding\Http\Requests;
use WebCoding\Http\Controllers\Controller;
use WebCoding\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with('users', 'categories')->enabled()->newest()->paginate(6);
        return view('news.index', compact('news'));
    }

    /**
     * Display the specified resource.
     *
     * @param string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $news = News::findBySlug($slug);
        if( !$news ) {
            abort(404);
        }

        return view('news.view', compact('news'));
    }

    public function create()
    {
        return view('news.propose');
    }

    public function store(Request $request)
    {

    }

    public function edit()
    {

    }

    public function update(Request $request)
    {

    }

    /**
     * Supprime une news
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if( $news->published ) {
            alert()->error('Vous ne pouvez pas supprimer un article publié');
            return redirect()->route('profile.news.index');
        }

        $news->destroy();
        alert()->success('L\'article a correctement été supprimé !');
        return redirect()->route('profile.news.index');
    }
}
