@extends('layouts.default')

@section('title', 'Gestion des contacts')

@section('content')
    @include('partials.header', [
        'title' =>  'Gestion des contacts',
        'navs'  =>  [
            0   =>  [
                'title' =>  'Gestion des contacts',
                'link'  =>  ''
            ]
        ]
    ])

    <div class="container">
        <h2 class="right-line">Mes demandes de contact</h2>
        <div class="row">
            @forelse( $requests as $u )
                @include('partials.users.user_card', ['accept' => true])
            @empty
                <div class="alert alert-info">
                    <p class="text-center">Vous n'avez aucune demande de contact</p>
                </div>
            @endforelse
        </div>
        <h2 class="right-line">Mes contacts</h2>
        <div class="row">
            @forelse( $friends as $u )
                @include('partials.users.user_card')
            @empty
                <div class="alert alert-info">
                    <p class="text-center">Vous n'avez aucun contact pour le moment.</p>
                </div>
            @endforelse
        </div>

    </div>

@stop
