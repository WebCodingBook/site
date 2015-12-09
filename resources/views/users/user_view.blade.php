@extends('users.user_layout')

@if( Auth::check() && Auth::user()->id == $user->id)
    @section('title', 'Mon fil d\'actualité')
@else
    @section('title',  'Fil d\'actualité de "' . $user->full_name . '"')
@endif

@section('header')

    @include('partials.header', [
        'title' =>  'Fil d\'actualité de "' . $user->full_name . '"',
        'navs'  =>  [
            0   =>  [
                'title' =>  'Utilisateurs',
                'link'  =>  '#'
            ],
            1   =>  [
                'title' =>  $user->full_name,
                'link'  =>  '',
            ]
        ]
    ])

@endsection

@section('profile')
    <div class="container">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-8">
                <h2 class="right-line no-margin-top">Activitées récentes</h2>
                <ul class="timeline-2">
                    @if( Auth::check() && Auth::user()->id === $user->id )
                    @include('activities.form')
                    @endif

                    @each('activities.activity_li_post', $activities, 'activity')

                <div class="text-center">
                    {!! $activities->render() !!}
                </div>
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
                @forelse( $user->lastFriends(3) as $friend )
                <div class="media">
                    <a class="pull-left" href="{{ route('user.view', $friend->username) }}"><img class="img-responsive" src="{{ $friend->avatar() }}" /></a>
                    <h4 class="media-heading">{{ $friend->full_name }}</h4>
                    @if( empty($friend->country) || empty($friend->city) )
                    <p><small><i class="fa fa-calendar"></i> {{ $friend->created_at }}</small></p>
                    @else
                    <p><small><i class="fa fa-map-marker"></i> {{ $friend->country }}, {{ $friend->city }}</small></p>
                    @endif
                </div>
                @empty
                <p class="text-center">Aucun contact, <a href="#">Ajoutez le</a> à vos contacts</p>
                @endforelse
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

@section('js')

    <script type="text/javascript">
    $(document).ready(function() {

    });
    </script>

@stop