@extends('users.user_layout')

@section('profile')
    <div class="container">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-8">
                <h2 class="right-line no-margin-top">Activité récente</h2>
                <ul class="timeline-2">
                    @if( Auth::check() && Auth::user()->id === $user->id )
                    <li class="wow fadeInLeft">
                        <time class="timeline-time" datetime="">{{ Date::now()->format('d/m/Y') }} <span>{{ Date::now()->format('F') }}</span></time>
                        <i class="timeline-2-point"></i>
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-comment-o"></i> Poster une nouvelle activité</div>
                            <div class="panel-body">
                                {!! Form::open(['class' => 'form-vertical']) !!}
                                {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                {!! Form::submit('Poster votre nouvelle activité', ['class' => 'btn btn-ar btn-success btn-block']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </li>
                    @endif
                    <li class="wow fadeInLeft">
                        <time class="timeline-time" datetime="">14/1/2012 <span>Junuary</span></time>
                        <i class="timeline-2-point"></i>
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-comment-o"></i> Comment in <a href="#">Title post or article</a></div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, illum aspernatur placeat eveniet ullam modi asperiores perspiciatis labore animi odio ea dicta consectetur similique. Soluta officiis facilis velit sunt rem.</p>
                            </div>
                        </div>
                    </li>
                    <li  class="wow fadeInLeft">
                        <time class="timeline-time" datetime="">31/5/2014 <span>May</span></time>
                        <i class="timeline-2-point"></i>
                        <div class="panel panel-primary">
                            <div class="panel-heading"><i class="fa fa-picture-o"></i> Post an Image</div>
                            <div class="video">
                                <img src="{{ asset('assets/img/demo/office2.jpg') }}" alt="" width="100%" class="img-responsive">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <h2 class="right-line no-margin-top">Informations</h2>
                <ul class="list-unstyled">
                    <li><strong>Genre</strong> :  <i class="fa fa-mars"></i></li>
                    <li><strong>Statut</strong> : Célibataire</li>
                    <li><strong>Poste actuel</strong> : Développeur Web</li>
                </ul>
                <h2 class="right-line">Compétences</h2>
                <div class="progress progress-lg animated fadeInRight animation-delay-14">
                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        HTML5
                    </div>
                </div>
                <div class="progress progress-lg animated fadeInRight animation-delay-14">
                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                        CSS3
                    </div>
                </div>
                <div class="progress progress-lg animated fadeInRight animation-delay-14">
                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                        PHP
                    </div>
                </div>
                <div class="progress progress-lg animated fadeInRight animation-delay-14">
                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                        SQL
                    </div>
                </div>
                <h2 class="right-line no-margin-top">Derniers contacts</h2>
                @if( $user->friends()->count() )
                <div class="media">
                    <a class="pull-left" href="#"><img class="img-responsive" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI3MCIgaGVpZ2h0PSI3MCI+PHJlY3Qgd2lkdGg9IjcwIiBoZWlnaHQ9IjcwIiBmaWxsPSIjM2E1YTk3Ii8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzUiIHk9IjM1IiBzdHlsZT0iZmlsbDojZmZmO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NzB4NzA8L3RleHQ+PC9zdmc+" /></a>
                    <h4 class="media-heading">Ribes Alexandre</h4>
                    <p><small>France, Perpignan</small></p>
                </div>
                <div class="media">
                    <a class="pull-left" href="#"><img class="img-responsive" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI3MCIgaGVpZ2h0PSI3MCI+PHJlY3Qgd2lkdGg9IjcwIiBoZWlnaHQ9IjcwIiBmaWxsPSIjM2E1YTk3Ii8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzUiIHk9IjM1IiBzdHlsZT0iZmlsbDojZmZmO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NzB4NzA8L3RleHQ+PC9zdmc+" /></a>
                    <h4 class="media-heading">Ribes Alexandre</h4>
                    <p><small>France, Perpignan</small></p>
                </div>
                <div class="media">
                    <a class="pull-left" href="#"><img class="img-responsive" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI3MCIgaGVpZ2h0PSI3MCI+PHJlY3Qgd2lkdGg9IjcwIiBoZWlnaHQ9IjcwIiBmaWxsPSIjM2E1YTk3Ii8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzUiIHk9IjM1IiBzdHlsZT0iZmlsbDojZmZmO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NzB4NzA8L3RleHQ+PC9zdmc+" /></a>
                    <h4 class="media-heading">Ribes Alexandre</h4>
                    <p><small>Développeur Web <br/> France, Perpignan</small></p>
                </div>
                @else
                <p class="text-center">Aucun contact, <a href="#">Ajoutez le</a> à vos contacts</p>
                @endif
                <h2 class="right-line">Dernière photo</h2>
                <div class="panel panel-primary animated fadeInDown animation-delay-8">
                    <div class="panel-heading"><i class="fa fa-play-circle"></i>Titre de la photo</div>
                    <div class="video">
                        <img src="http://razonartificial.com/themes/reason/v1.4.5/assets/img/demo/w7.jpg" alt="...">
                    </div>
                </div>
                <h2 class="right-line">Dernière vidéo</h2>
                <div class="panel panel-primary animated fadeInDown animation-delay-8">
                    <div class="panel-heading"><i class="fa fa-play-circle"></i>Titre de la vidéo</div>
                    <div class="video">
                        <iframe src="http://player.vimeo.com/video/21081887?title=0&amp;byline=0&amp;portrait=0"></iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>


@stop