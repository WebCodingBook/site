@extends('layouts.default')

@section('content')
    <header class="profile-header">
        @if( Auth::check() && Auth::user()->id == $user->id )
            <div class="pull-left"><a class="button button-large button-plain button-border button-circle" href="{{ route('profile.edit') }}" alt="Modifier mon profil" title="Modifier mon profil"><i class="fa fa-pencil"></i></a></div>
        @endif
        <div class="dark-div">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-push-6">
                        <h1 class="animated fadeInDown animation-delay-1">{{ $user->full_name }}</h1>
                        <h2 class="animated fadeInDown animation-delay-2">{{ $user->professional }}</h2>
                        <div class="profile-header-btn text-center">
                            <a href="#" class="btn btn-ar btn-primary btn-lg animated fadeInLeft animation-delay-2"><i class="fa fa-paper-plane"></i> Le contacter</a>
                            <a href="#" class="btn btn-ar btn-danger btn-lg animated fadeInRight animation-delay-2"><i class="fa fa-download"></i> Télécharger son CV</a>
                        </div>
                        <div class="profile-header-social">
                            <a href="#" class="btn-social btn-social-white sm animated fadeInUp animation-delay-2"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="btn-social btn-social-white sm animated fadeInUp animation-delay-6"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="btn-social btn-social-white sm animated fadeInUp animation-delay-10"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="btn-social btn-social-white sm animated fadeInUp animation-delay-8"><i class="fa fa-linkedin"></i></a>
                            <a href="#" class="btn-social btn-social-white sm animated fadeInUp animation-delay-4"><i class="fa fa-github-alt"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-pull-6">
                        <div class="home-profile-img center-block text-center animated fadeInDown animation-delay-6">
                            <img src="{{ $user->avatar('medium') }}" alt="Author image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if( Auth::check() && $user->id != Auth::user()->id )
        @yield('header')
        @endif
    </header>
    <nav class="nav-profile">
        <div class="container">
            <div class="col-lg-8 col-lg-push-4 col-md-7 col-md-push-5 col-sm-6 col-sm-push-6">
                <ul class="profile-counters">
                    <li><a{!! Html::isActive('user.view') !!} href="{{ route('user.view', ['username' => $user->username]) }}"><i class="fa fa-home"></i> <span>Profil</span></a></li>
                    <li><a href="#"><i class="fa fa-suitcase"></i> <span>CV</span></a></li>
                    <li><a href="#"><i class="fa fa-user"></i> <span>A propos</span></a></li>
                    <li><a href="#"><i class="fa fa-picture-o"></i> <span>Photos</span></a></li>
                    <li><a href="#"><i class="fa fa-video-camera"></i> <span>Vidéos</span></a></li>

                    @if( Auth::check() && Auth::user()->id != $user->id )
                        <li><a{!! Html::isActive('user.friends') !!} href="{{ route('user.friends', ['username' => $user->username]) }}"><i class="fa fa-users"></i> <span>Contacts</span></a></li>

                        @if( Auth::user()->hasFriendRequestPending($user) )
                        <li id="request-sent"><a href="#" class="disabled"><i class="fa fa-user-plus em-warning"></i> <span class="em-warning">Demande envoyée</span></a></li>
                        @elseif( Auth::user()->hasFriendRequestReceived($user) )
                        <li id="accept-request"><a href="{{ route('friends.accept', ['username' => $user->username]) }}"><i class="fa fa-user-plus em-success"></i> <span class="em-success">Accepter</span></a> </li>
                        @elseif( Auth::user()->isFriendWith($user) )
                        <li><a href="#" class="disabled"><i class="fa fa-code-fork em-success"></i> <span class="em-success">En contact</span></a> </li>
                        @else
                        <li id="send-request"><a href="{{ route('friends.add', ['username' => $user->username]) }}"><i class="fa fa-user-plus"></i> <span>Ajouter</span></a></li>
                        @endif
                    @else
                    <li><a href="{{ route('friends.index') }}"><i class="fa fa-users"></i> <span>Mes contacts</span></a> </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('profile')

@stop

@section('js')

@stop