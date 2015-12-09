<li class="wow fadeInLeft">
    <time class="timeline-time" datetime="">{{ Date::now()->format('d/m/Y') }} <span>{{ Date::now()->format('F') }}</span></time>
    <span class="timeline-2-avatar"><img src="{{ Auth::user()->avatar() }}" alt="{{ Auth::user()->full_name }}" class="img-circle img-responsive" title="{{ Auth::user()->full_name }}"></span>
    <div class="panel panel-default">
        <div class="panel-body">

            {!! Form::open(['method' => 'post', 'route' => 'activity.store', 'class' => 'activity-form']) !!}
            <div class="form-group">
                {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Quoi de neuf ' . Auth::user()->name . ' ?']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Poster votre nouvelle activité', ['class' => 'btn btn-ar btn-success pull-right submit-activity']) !!}
                <a class="btn btn-ar btn-default btn-sm post-type disabled" data-type="status" href="#" alt="Publication texte" title="Publication texte"><i class="fa fa-paragraph fa-lg"></i></a>
                <a class="btn btn-ar btn-default btn-sm post-type" href="#" data-type="picture" alt="Publication photo" title="Publication photo"><i class="fa fa-camera fa-lg"></i></a>
                <a class="btn btn-ar btn-default btn-sm post-type" data-type="video" href="#" alt="Publication vidéo" title="Publication vidéo"><i class="fa fa-video-camera fa-lg"></i></a>
                <a class="btn btn-ar btn-default btn-sm post-type" data-type="link" href="#" alt="Publication lien" title="Publication lien"><i class="fa fa-link fa-lg"></i></a>
                <a class="btn btn-ar btn-default btn-sm post-type" data-type="code" href="#" alt="Publication code" title="Publication code"><i class="fa fa-code fa-lg"></i></a>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</li>