<div class="media" id="comment_{{ $comment->id }}">
    <a class="pull-left" href="{{ route('user.view', ['username' => $comment->user->username]) }}"><img src="{{ $comment->user->avatar('comment') }}" class="media-object img-circle" alt="{{ $comment->user->full_name }}" title="{{ $comment->user->full_name }}"></a>
    <div class="media-body">
        @can('delete', $comment)
        <span class="pull-right">
            {!! Form::open(['method' => 'DELETE', 'route' => ['reply.destroy', $comment->id]]) !!}
            {!! Form::hidden('id', $comment->id) !!}
            <button type="submit" class="em-danger delete-confirm" data-delete="comment" alt="Supprimer le commentaire" title="Supprimer le commentaire" data-id="{{ $comment->id }}" data-href="{{ route('reply.destroy', ['reply' => $comment->id]) }}"><i class="fa fa-trash"></i></button>
            {!! Form::close() !!}
        </span>
        @endcan
        <h4 class="media-heading small">
            <ul class="list-inline">
                <li><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</li>
                <li><span class="like-count">{{ $comment->likes->count() }}</span> <a alt="Aimer ce commentaire" title="Aimer ce commentaire" class="like em-danger" href="{{ route('like.activity.comment', ['reply' => $comment->id]) }}" data-element="comment_{{ $comment->id }}"> <i class="fa fa-heart"></i></a></li>
            </ul>

        </h4>
        <p @can('update', $comment)class="comment"@endcan id="{{ $comment->id }}">{{ $comment->content }}</p>
        @can('update', $comment)
        {!! Form::model($comment, ['method' => 'PUT', 'route' => ['reply.update', $comment->id], 'class' => 'form-comment-edit']) !!}
        <div class="form-group">
            {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 2]) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Mettre à jour', ['class' => 'btn btn-ar btn-primary pull-right submit-edit-comment']) !!}
        </div>
        {!! Form::close() !!}
        @endcan
    </div>
</div>