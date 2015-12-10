@extends('layouts.default')

@section('title', 'Accueil')

@section('content')

    <div class="container margin-top">
        <div class="row">
            <section class="col-md-8">
                <h2 class="right-line">Dernières activitées</h2>
                <ul class="timeline-2">
                    @if( Auth::check() )
                        @include('activities.form')
                    @endif
                    @each('activities.activity_li_post', $activities, 'activity')
                </ul>

                <div class="text-center">
                    {!! $activities->render() !!}
                </div>
            </section>
            <aside class="col-md-4">
                <h2 class="right-line">Dernières offres d'emploi</h2>
                <div class="content-box box-default">
                   <a href="#"><h5 class="content-box-title">Développeur Web de la mort qui tue avec un putain de titre bien méga long</h5></a>
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-building"></i> <a href="#">WebCodingBook</a></li>
                        <li><i class="fa fa-map-marker"></i> <a href="#">Perpignan</a></li>
                        <li><i class="fa fa-euro"></i> 25k</li>
                    </ul>
                </div>
                <div class="content-box box-default">
                    <a href="#"><h5 class="content-box-title">Développeur Web de la mort qui tue avec un putain de titre bien méga long</h5></a>
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-building"></i> <a href="#">WebCodingBook</a></li>
                        <li><i class="fa fa-map-marker"></i> <a href="#">Perpignan</a></li>
                        <li><i class="fa fa-euro"></i> 25k</li>
                    </ul>
                </div>
                <h2 class="right-line">Derniers tutoriels</h2>
                <div class="thumbnail">
                    <img src="{{ asset('assets/img/demo/1.jpg') }}" alt="title">
                    <div class="caption">
                        <h3>Laravel & Eloquent : les relations</h3>
                        <ul class="list-unstyled list-inline text-center">
                            <li><i class="fa fa-clock-o"></i> 35 mins</li>
                            <li><i class="fa fa-user"></i> Par SquallX</li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>

@stop