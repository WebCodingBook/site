<section class="section ajax-body bg-white">
    <div class="container">

        @include('activities.activity_post', ['activity' => $act])

        <div class="comments well margin-top-20" data-activity="{{ $act->id }}">
            @forelse( $comments as $comment )
                @include('activities.comment', ['comment' => $comment])
            @empty
                <p class="text-center no-comment">Aucun commentaire, soyez le premier à en poster un ;)</p>
            @endforelse
        </div>
        @if( Gate::forUser(Auth::user())->allows('comment', $act ) )
        {!! Form::open(['method' => 'POST', 'route' => 'reply.store', 'class' => 'form-activity-reply']) !!}
        <div class="form-group">
            {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Laisser un commentaire...']) !!}
            {!! Form::hidden('activity_id', $act->id) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Commenter', ['class' => 'btn btn-ar btn-success btn-block submit-comment']) !!}
        </div>
        {!! Form::close() !!}
        @endif
    </div>

    <a href="#" class="ajax-close icon icon-hover icon-primary icon-circle icon-sm" data-dismiss="close"><i class="fa fa-close"></i></a>
</section>

