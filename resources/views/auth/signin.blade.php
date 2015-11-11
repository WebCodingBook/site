@extends('layouts.default')

@section('title', 'Se connecter')

@section('content')
    @include('partials.header', [
        'title' =>  'Se connecter',
        'navs'  =>  [
            0   =>  [
                'title' =>  'Se connecter',
                'link'  =>  route('auth.signin'),
            ]
        ]
    ])
    <div class="container">

        <div class="center-block logig-form">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Se connecter</div>
                <div class="panel-body">
                    @include('partials.errors')
                    <form role="form" role="form" method="POST" action="{{ route('auth.signin') }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group login-input">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Votre adresse email">
                            </div>
                            @if( $errors->has('email') )
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group login-input">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                            </div>
                            @if( $errors->has('password') )
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox_remember" name="remember">
                                <label for="checkbox_remember">Se souvenir de moi</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-ar btn-primary pull-right">Me connecter</button>
                            <a href="#" class="social-icon-ar sm twitter animated fadeInDown animation-delay-2"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="social-icon-ar sm google-plus animated fadeInDown animation-delay-3"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="social-icon-ar sm facebook animated fadeInDown animation-delay-4"><i class="fa fa-facebook"></i></a>
                            <hr class="dotted margin-10">
                            <a href="{{ route('auth.signup') }}" class="btn btn-ar btn-success pull-right">Créer un compte</a>
                            <a href="#" class="btn btn-ar btn-warning">Mot de passe oublié</a>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop