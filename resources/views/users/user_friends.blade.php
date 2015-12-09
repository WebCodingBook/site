@extends('users.user_layout')

@if( Auth::check() && Auth::user()->id == $user->id)
    @section('title', 'Mes contacts')
@else
    @section('title',  'Contacts de "' . $user->full_name . '"')
@endif

@section('header')

    @include('partials.header', [
        'title' =>  'Contacts de "' . $user->full_name . '"',
        'navs'  =>  [
            0   =>  [
                'title' =>  'Utilisateurs',
                'link'  =>  route('users.index')
            ],
            1   =>  [
                'title' =>  $user->full_name,
                'link'  =>  route('user.view', $user->username),
            ],
            2   =>  [
                'title' =>  'Ses contacts',
                'link'  =>  '#'
            ]
        ]
    ])

@endsection

@section('profile')
<div class="container">
    <div class="clearfix"></div>
    <div class="row">
        @if( Auth::user()->hasFriendRequestPending($user) )
            <div class="col-md-12">
                <div class="alert alert-royal text-center"><strong><i class="fa fa-info"></i></strong> {{ $user->full_name }} n'a pas encore accepté votre demande</div>
            </div>
        @endif
        @forelse( $user->friends() as $u )
        @include('partials.users.user_card')
        @empty
            @if( !Auth::user()->hasFriendRequestPending($user) )
            <div class="col-md-12">
                <div class="alert alert-info">
                    <p class="text-center">Aucun contact pour le moment, <a href="#">Ajoutez le</a> dans votre liste</p>
                </div>
            </div>
            @endif
        @endforelse
    </div>

</div>
@stop