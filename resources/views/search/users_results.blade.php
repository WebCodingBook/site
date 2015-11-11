@extends('layouts.default')

@section('title', 'Résultats de votre recherche')

@section('content')
    @include('partials.header', [
        'title' =>  'Résultats pour votre recherche "' . Request::input('search_user') . '"',
        'navs'  =>  [
            0   =>  [
                'title' =>  'Recherche',
                'link'  =>  '',
            ]
        ]
    ])

    <div class="container">

        <h1 class="section-title text-center no-margin-top">Rechercher un utilisateur</h1>
        <div class="panel panel-border">
            <div class="panel-body">
                <form method="post" action="{{ route('search.users') }}">
                    {{ csrf_field() }}
                    <div class="input-group col-md-8 col-md-offset-2">
                        <input type="text" name="search_user" class="form-control" placeholder="Rechercher une personne">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-ar btn-primary" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @if( !empty($users) )
                @foreach( $users as $user )
                    @include('partials.users.user_card')
                @endforeach
            @else
                <p class="text-center">Aucun résultat pour votre recherche</p>
            @endif
        </div>

        {!! $users->render() !!}
    </div>
@stop