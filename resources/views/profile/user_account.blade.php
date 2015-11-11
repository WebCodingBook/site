@extends('profile.user_layout')

@section('profile_form')

    <div class="panel-body">
        <h2 class="section-title no-margin-top">Modifier mon compte</h2>
        @include('partials.errors')
        {!! Form::model($user, ['route' => 'profile.update', 'method' => 'post', 'class' => 'form-horizontal']) !!}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="label-control col-sm-2">Adresse email</label>
            <div class="col-sm-10">
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                {!! Form::hidden('user_id', $user->id) !!}
                @if( $errors->has('email') )
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
            <label for="firstname" class="label-control col-sm-2">Votre nom</label>
            <div class="col-sm-10">
                {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
                @if( $errors->has('firstname') )
                    <span class="help-block">{{ $errors->first('firstname') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
            <label for="lastname" class="label-control col-sm-2">Votre prénom</label>
            <div class="col-sm-10">
                {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
                @if( $errors->has('lastname') )
                    <span class="help-block">{{ $errors->first('lastname') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit('Modifier mon compte', ['class' => 'btn btn-ar btn-success btn-block']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@stop