<div class="panel panel-default">
    <div class="panel-heading">

        @if( Auth::check() && Auth::user()->id === $activity->user_id )
        <span class="pull-right">
            {!! Form::open(['method' => 'DELETE', 'route' => ['activity.destroy', $activity->id]]) !!}
                <button class="edit-form" alt="Mettre à jour la publication" title="Mettre à jour la publication" href="#" data-id="{{ $activity->id }}"><i class="fa fa-pencil"></i></button>
                {!! Form::hidden('id', $activity->id) !!}
                <button type="submit" class="em-danger delete-confirm" alt="Supprimer la publication" title="Supprimer à jour la publication" data-id="{{ $activity->id }}" data-href="{{ route('activity.destroy', ['activity' => $activity->id]) }}"><i class="fa fa-trash"></i></button>
            {!! Form::close() !!}
        </span>
        @endif

        <a alt="Voir la publication" title="Voir la publication" href="{{ route('activity.show', ['id' => $activity->id]) }}"><i class="fa fa-comment-o"></i></a>
        <a alt="{{ $activity->user->full_name }}" title="{{ $activity->user->full_name }}" href="{{ route('user.view', ['username' => $activity->user->username]) }}">{{ $activity->user->full_name }}</a> a
            @if( $activity->type == 'status') publié
            @endif
    </div>
    <div class="panel-body" id="act_{{ $activity->id }}">
        <p id="content_{{ $activity->id }}">{{ $activity->content }}</p>
        @if( Auth::check() )
            @if( $activity->user->id === Auth::user()->id)
            {!! Form::model($activity, ['method' => 'PUT', 'class' => 'form-edit', 'route' => ['activity.update', $activity->id]]) !!}
            <div class="form-group">
                {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 3]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Mettre à jour la publication', ['class' => 'btn btn-ar btn-success pull-right', 'id' => 'submit-activity']) !!}
            </div>
            {!! Form::close() !!}
            @endif

            {{--
            {!! Form::open(['method' => 'POST', 'class' => 'form-reply', 'route' => ['activity.reply', $activity->id]]) !!}
            <div class="form-group">
                {!! Form::textarea('reply', old('reply'), ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Lui laisser un commentaire...']) !!}
                {!! Form::hidden('activity_id', $activity->id) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Commenter', ['class' => 'btn btn-ar btn-primary btn-block']) !!}
            </div>
            {!! Form::close() !!}
            --}}
        @endif
    </div>
    <div class="panel-footer">
        <p class="pull-right">
            <a alt="Partager sur Facebook" title="Partager sur Facebook" href="#" class="social-icon-ar sm facebook"><i class="fa fa-facebook"></i></a>
            <a alt="Partager sur Twitter" title="Partager sur Twitter" href="#" class="social-icon-ar sm twitter"><i class="fa fa-twitter"></i></a>
            <a alt="Partager sur Linkedin" title="Partager sur Linkedin" href="#" class="social-icon-ar sm linkedin"><i class="fa fa-linkedin"></i></a>
            <a alt="Partager sur Google Plus" title="Partager sur Google Plus" href="#" class="social-icon-ar sm google-plus"><i class="fa fa-google-plus"></i></a>
            <a alt="Partager sur Pinterest" title="Partager sur Pinterest" href="#" class="social-icon-ar sm pinterest"><i class="fa fa-pinterest"></i></a>
        </p>
        <ul class="list-inline">
            <li>
                <a href="{{ route('activity.comments', ['activity' => $activity->id]) }}" data-target="ajax-modal" class="get-comments">
                    <i class="fa fa-comments em-primary"></i> {{ count($activity->comments) }}commentaire{{ count($activity->comments) > 1 ? 's' : '' }}
                </a>
            </li>

            <li class="hidden-xs"><i class="fa fa-clock-o"></i> {{ $activity->timestamp }}</li>
            <li><a alt="Aimer cette publication" title="Aimer cette publication" class="em-danger" href=""><i class="fa fa-heart"></i></a> 33</li>
        </ul>
    </div>
</div>