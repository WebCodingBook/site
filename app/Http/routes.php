<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Pages principales
 */

Route::group(['namespace' => 'Site'], function() {

    Route::get('/', ['uses' => 'FrontController@index', 'as' => 'front.index']);

    /**
     * Recherche
     */
    Route::get('search/users', ['uses' => 'SearchController@users', 'as' => 'search.users.index']);
    Route::post('search/users', ['uses' => 'SearchController@users', 'as' => 'search.users']);

});

/*
 * Utilisateurs
 */

Route::group(['namespace' => 'Users', 'prefix' => 'users'], function() {

    Route::get('/', ['uses' => 'ProfileController@index', 'as' => 'users.index']);
    Route::get('{username}', ['uses' => 'ProfileController@profile', 'as' => 'user.view'])->where('username', '[a-zA-Z0-9]+');
    Route::get('{username}/contacts', ['uses' => 'ProfileController@friends', 'as' => 'user.friends'])->where('username', '[a-zA-Z0-9]+');

});

/*
 * Visiteurs uniquement
 */
Route::group(['middleware' => 'guest', 'namespace' => 'Auth'], function() {
    /*
     * Inscription / Connexion
     */
    Route::get('signup', ['uses' => 'AuthController@getSignup', 'as' => 'auth.signup']);
    Route::post('signup', ['uses' => 'AuthController@postSignup', 'as' => 'auth.signup']);
    Route::get('signin', ['uses' => 'AuthController@getSignin', 'as' => 'auth.signin']);
    Route::post('signin', ['uses' => 'AuthController@postSignin', 'as' => 'auth.signin']);
});

Route::group(['middleware' => 'auth'], function() {

    /*
     * Edition du profil
     */
    Route::group(['prefix' => 'profile', 'namespace' => 'Users'], function() {

        Route::get('edit', ['uses' => 'ProfileController@editAccount', 'as' => 'profile.edit']);
        Route::get('edit/password', ['uses' => 'ProfileController@editPassword', 'as' => 'profile.edit.password']);
        Route::get('edit/infos', ['uses' => 'ProfileController@editInfos', 'as' => 'profile.edit.infos']);
        Route::post('edit', ['uses' => 'ProfileController@updateAccount', 'as' => 'profile.update']);
        Route::post('edit/password', ['uses' => 'ProfileController@updatePassword', 'as' => 'profile.update.password']);
        Route::post('edit/infos', ['uses' => 'ProfileController@updateInfos', 'as' => 'profile.update.infos']);

    });

    /**
     * Gestion des contacts
     */
    Route::group(['namespace' => 'Users', 'prefix' => 'contacts'], function() {

        Route::get('/', ['uses' => 'FriendsController@index', 'as' => 'friends.index']);
        Route::get('add/{username}', ['uses' => 'FriendsController@add', 'as' => 'friends.add'])->where('username', '[a-zA-Z0-9]+');
        Route::get('accept/{username}', ['uses' => 'FriendsController@accept', 'as' => 'friends.accept'])->where('username', '[a-zA-Z0-9]+');

    });

    /**
     * Routes liées aux activités
     */
    Route::group(['namespace' => 'Timeline'], function() {

        //  Activités
        Route::resource('activity', 'ActivitiesController');

        //  Commentaires
        Route::resource('reply', 'ActivitiesCommentsController', ['only' => ['store', 'update', 'destroy']]);

        //  Commentaires d'une activité
        Route::get('activity/{activity}/comments', ['uses' => 'ActivitiesCommentsController@comments', 'as' => 'activity.comments'])->where('activity', '[0-9]+');

        //  Like d'une activité
        Route::get('activity/{activity}/like', ['as' => 'like.activity', 'uses' => 'LikesController@likeActivity'])->where('activity', '[0-9]+');

        //  Like d'un commentaire
        Route::get('reply/{reply}/like', ['uses' => 'LikesController@likeActivityComment', 'as' => 'like.activity.comment'])->where('reply', '[0-9]+');

    });

    //  Déconnexion
    Route::get('signout', ['uses' => 'Auth\AuthController@getSignOut', 'as' => 'auth.signout']);

});

    /*
     * Activites
     */

    //Route::post('activity/{activity}/reply', ['uses' => 'ActivitiesCommentsController@create', 'as' => 'activity.reply']);

    //Route::get('activity/{id}', ['uses' => 'ActivitiesController@show', 'as' => 'activity.get']);
    //Route::post('activity', ['uses' => 'ActivitiesController@store', 'as' => 'activity.store']);
    //Route::delete('activity', ['uses' => 'ActivitiesController@destroy', 'as' => 'activity.destroy']);

