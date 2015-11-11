@extends('layouts.default')

@section('title', 'Modifer mon profil')

@section('content')
    @include('partials.header', [
        'title'     =>  'Modifier mon profil',
        'navs'      =>  [
            0   =>  [
                'title' =>  Auth::user()->full_name,
                'link'  =>  route('user.view', ['username' => Auth::user()->username])
            ],
            1   =>  [
                'title' =>  'Modifier mon profil',
                'link'  =>  ''
            ]
        ]
    ])

    <section class="container">
        <div class="row">
            <div class="col-md-3">
                @include('partials.users.profile_menu')
            </div>
            <div class="col-md-9 panel panel-border">
                @yield('profile_form')
            </div>
        </div>
    </section>

@stop