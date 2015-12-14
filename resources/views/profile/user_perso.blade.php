@extends('profile.user_layout')

@section('profile_form')

    <div class="panel-body">
        <h2 class="section-title no-margin-top">Personnaliser mon profil</h2>

        @if( !empty($cover) )
            <a href="#" class="thumbnail"><img src="{{ asset('uploads/users/covers/thumb/' . $cover) }}" alt="Couverture" title="Couverture" class="img-responsive"></a>
        @endif

        @include('partials.errors')
        {!! Form::open(['route' => 'profile.update.perso', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}
        <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
            <label for="password_confirmation" class="label-control col-sm-2">Ma photo de couverture</label>
            <div class="col-sm-10">
                {!! Form::hidden('user_id', Auth::user()->id) !!}
                {!! Form::file('cover', ['class' => 'form-control']) !!}
                @if( $errors->has('cover') )
                    <span class="help-block">{{ $errors->first('cover') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit('Personnaliser mon profil', ['class' => 'btn btn-ar btn-success btn-block']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@stop