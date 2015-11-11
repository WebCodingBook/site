@extends('profile.user_layout')

@section('profile_form')

    <div class="panel-body">
        <h2 class="section-title no-margin-top">Modifier mon mot de passe</h2>
        @include('partials.errors')
        {!! Form::open(['route' => 'profile.update.password', 'method' => 'post', 'class' => 'form-horizontal']) !!}
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="label-control col-sm-2">Mot de passe</label>
            <div class="col-sm-10">
                {!! Form::password('password', ['class' => 'form-control']) !!}
                {!! Form::hidden('user_id', Auth::user()->id) !!}
                @if( $errors->has('password') )
                    <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password_confirmation" class="label-control col-sm-2">Confirmation</label>
            <div class="col-sm-10">
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                @if( $errors->has('password_confirmation') )
                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit('Modifier mon mot de passe', ['class' => 'btn btn-ar btn-success btn-block']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@stop