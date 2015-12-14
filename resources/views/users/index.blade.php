@extends('users.user_layout')

@section('title', 'Liste des utilisateurs')

@section('header')

    @include('partials.header', [
        'title' =>  'Liste des utilisateurs',
        'navs'  =>  [
            0   =>  [
                'title' =>  'Utilisateurs',
                'link'  =>  route('users.index')
            ],
        ]
    ])

@section('content')

    <div class="row">
        @foreach($users as $u)
            @include('partials.users.user_card', ['u' => $u])
        @endforeach
    </div>

@stop