{!! Form::open(['method' => 'put', 'route' => 'activity.update', 'class' => 'activity-form']) !!}
<div class="form-group">
    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 3, 'value' => $content]) !!}
</div>
<div class="form-group">
    {!! Form::submit('Mettre à jour la publication', ['class' => 'btn btn-ar btn-success pull-right submit-activity']) !!}
</div>
{!! Form::close() !!}