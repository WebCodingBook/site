@extends('layouts.default')

@section('title', 'M\'enregistrer')

@section('content')
    @include('partials.header', [
        'title' =>  'S\'enregistrer',
        'navs'  =>  [
            0   =>  [
                'title' =>  'S\'enregistrer',
                'link'  =>  route('auth.signup'),
            ]
        ]
    ])

    <div class="container">
        <div class="center-block logig-form">
            <div class="panel panel-primary margin-top-80">
                <div class="panel-heading text-center">S'enregistrer</div>
                <div class="panel-body">
                    @include('partials.errors')
                    <form role="form" role="form" method="POST" action="{{ route('auth.signup') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group login-input">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Votre adresse email">
                            </div>
                            @if( $errors->has('email') )
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="input-group login-input">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Votre pseudonyme">
                            </div>
                            @if( $errors->has('username') )
                                <span class="help-block">{{ $errors->first('username') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group login-input">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Votre mot de passe">
                            </div>
                            @if( $errors->has('password') )
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group login-input">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmez votre mot de passe">
                            </div>
                            @if( $errors->has('password') )
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox_rules" name="accept">
                                <label for="checkbox_rules">J'accepte les conditions d'utilisation</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-ar btn-primary pull-right">M'enregistrer</button>
                            <a href="#" class="social-icon-ar sm twitter animated fadeInDown animation-delay-2"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="social-icon-ar sm google-plus animated fadeInDown animation-delay-3"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="social-icon-ar sm facebook animated fadeInDown animation-delay-4"><i class="fa fa-facebook"></i></a>
                            <hr class="dotted margin-10">
                            <a href="{{ route('auth.signin') }}" class="btn btn-ar btn-success pull-right">J'ai déjà un compte</a>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop