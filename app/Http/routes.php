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
Route::get('/', ['uses' => 'FrontController@index', 'as' => 'front.index']);

/**
 * Recherche
 */
Route::post('search/users', ['uses' => 'SearchController@usersResults', 'as' => 'search.users']);

/*
 * Utilisateurs
 */
Route::get('user/{username}', ['uses' => 'Users\ProfileController@profile', 'as' => 'user.view'])->where('username', '[a-zA-Z0-9]+');
Route::get('user/{username}/contacts', ['uses' => 'Users\ProfileController@friends', 'as' => 'user.friends'])->where('username', '[a-zA-Z0-9]+');

/*
 * Visiteurs uniquement
 */
Route::group(['middleware' => 'guest'], function() {
    /*
     * Inscription / Connexion
     */
    Route::get('signup', ['uses' => 'Auth\AuthController@getSignup', 'as' => 'auth.signup']);
    Route::post('signup', ['uses' => 'Auth\AuthController@postSignup', 'as' => 'auth.signup']);
    Route::get('signin', ['uses' => 'Auth\AuthController@getSignin', 'as' => 'auth.signin']);
    Route::post('signin', ['uses' => 'Auth\AuthController@postSignin', 'as' => 'auth.signin']);
});

/*
 * Utilisateurs connectés
 */
Route::group(['middleware' => 'auth'], function() {
    /*
     * Profil utilisateur
     */
    Route::get('profile/edit', ['uses' => 'Users\ProfileController@editAccount', 'as' => 'profile.edit']);
    Route::get('profile/edit/password', ['uses' => 'Users\ProfileController@editPassword', 'as' => 'profile.edit.password']);
    Route::get('profile/edit/infos', ['uses' => 'Users\ProfileController@editInfos', 'as' => 'profile.edit.infos']);
    Route::post('profile/edit', ['uses' => 'Users\ProfileController@updateAccount', 'as' => 'profile.update']);
    Route::post('profile/edit/password', ['uses' => 'Users\ProfileController@updatePassword', 'as' => 'profile.update.password']);
    Route::post('profile/edit/infos', ['uses' => 'Users\ProfileController@updateInfos', 'as' => 'profile.update.infos']);

    //  Contacts
    Route::get('contacts', ['uses' => 'FriendsController@index', 'as' => 'friends.index']);

    //  Déconnexion
    Route::get('signout', ['uses' => 'Auth\AuthController@getSignOut', 'as' => 'auth.signout']);
});


