@extends('profile.user_layout')

@section('profile_form')

    <div class="panel-body">
        <h2 class="section-title no-margin-top">Modifier mes informations</h2>
        @include('partials.errors')
        {!! Form::model(Auth::user(), ['route' => 'profile.update.infos', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'infos']) !!}

        <div class="form-group{{ $errors->has('job') ? ' has-error' : '' }}">
            <label for="birthday" class="label-control col-sm-2">Profession</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                    {!! Form::text('job', null, ['class' => 'form-control']) !!}
                </div>
                @if( $errors->has('job') )
                    <span class="help-block">{{ $errors->first('job') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
            <label for="birthday" class="label-control col-sm-2">Pays</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map"></i></span>
                    {!! Form::text('country', null, ['class' => 'form-control']) !!}
                </div>
                @if( $errors->has('country') )
                    <span class="help-block">{{ $errors->first('country') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
            <label for="birthday" class="label-control col-sm-2">Département</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                    {!! Form::text('department', null, ['class' => 'form-control']) !!}
                </div>
                @if( $errors->has('department') )
                    <span class="help-block">{{ $errors->first('department') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            <label for="birthday" class="label-control col-sm-2">Ville</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
                    {!! Form::text('city', null, ['class' => 'form-control']) !!}
                </div>
                @if( $errors->has('city') )
                    <span class="help-block">{{ $errors->first('city') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
            <label for="birthday" class="label-control col-sm-2">Anniversaire</label>
            <div class="col-sm-10">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    {!! Form::text('birthday', null, ['class' => 'form-control']) !!}
                </div>
                {!! Form::hidden('user_id', Auth::user()->id) !!}
                @if( $errors->has('birthday') )
                    <span class="help-block">{{ $errors->first('birthday') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                {!! Form::submit('Modifier mes informations', ['class' => 'btn btn-ar btn-success btn-block']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.fr.min.js') }}"></script>
    <script type="text/javascript">
        $('#infos .input-group.date').datepicker({
            format: "dd/mm/yyyy",
            language: "fr",
            forceParse: true
        });
    </script>
@stop