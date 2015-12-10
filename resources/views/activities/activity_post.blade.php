@if( $activity->type == 'status' )
    <div class="panel panel-default">
        <div class="panel-heading">
            @can('delete', $activity)
            <span class="pull-right">
                {!! Form::open(['method' => 'DELETE', 'route' => ['activity.destroy', $activity->id]]) !!}
                {!! Form::hidden('id', $activity->id) !!}
                <button type="submit" class="em-danger delete-confirm" alt="Supprimer la publication" title="Supprimer la publication" data-id="{{ $activity->id }}" data-href="{{ route('activity.destroy', ['activity' => $activity->id]) }}"><i class="fa fa-trash"></i></button>
                {!! Form::close() !!}
                </span>
            @endcan

            <a alt="Voir la publication" title="Voir la publication" href="{{ route('activity.show', ['id' => $activity->id]) }}"><i class="fa fa-comment-o"></i></a>
            <a alt="{{ $activity->user->full_name }}" title="{{ $activity->user->full_name }}" href="{{ route('user.view', ['username' => $activity->user->username]) }}">{{ $activity->user->full_name }}</a> a
            @if( $activity->type == 'status') publié
            @endif
        </div>
        <div class="panel-body">
            <p class="activity-content">{{ $activity->content }}</p>
            @if( Auth::check() && Gate::forUser(Auth::user())->allows('update', $activity) )
                {!! Form::model($activity, ['method' => 'PUT', 'class' => 'form-edit', 'route' => ['activity.update', $activity->id]]) !!}
                <div class="form-group">
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 3]) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Mettre à jour la publication', ['class' => 'btn btn-ar btn-success pull-right activity-edit-submit']) !!}
                </div>
                {!! Form::close() !!}
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
                @if( Route::current()->getName() !== 'activity.show' && Gate::forUser(Auth::user())->allows('comment', $activity ) )
                    <li>
                        <a href="{{ route('activity.comments', ['activity' => $activity->id]) }}" data-target="ajax-modal" class="get-comments">
                            <i class="fa fa-comments em-primary"></i> <span class="total-coms">{{ count($activity->comments) }}</span> commentaire{{ count($activity->comments) > 1 ? 's' : '' }}
                        </a>
                    </li>
                @endif
                <li class="hidden-xs"><i class="fa fa-clock-o"></i> {{ $activity->timestamp }}</li>
                <li><span class="like-count">{{ $activity->likes->count() }}</span> <a alt="Aimer cette publication" title="Aimer cette publication" class="like em-danger" href="{{ route('like.activity', ['activity' => $activity->id]) }}" data-element="activity_{{ $activity->id }}"> <i class="fa fa-heart"></i></a></li>
            </ul>
        </div>
    </div>
@endif