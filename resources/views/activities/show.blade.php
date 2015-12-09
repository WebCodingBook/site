@extends('layouts.default')

@section('title', 'Activité du ' . $activity->date . ' par ' . $activity->user->full_name)


@section('content')

    @include('partials.header', [
        'title' =>  'Activité du ' . $activity->date,
        'navs'  =>  [
            0   =>  [
                'title' =>  'Utilisateurs',
                'link'  =>  route('users.index')
            ],
            1   =>  [
                'title' =>  $activity->user->full_name,
                'link'  =>  route('user.view', ['username' => $activity->user->username])
            ],
            2   =>  [
                'title' =>  'Activité du ' . $activity->date,
                'link'  =>  ''
            ]
        ]
    ])

    <div class="container margin-top-20">
        <ul class="timeline-2">
            @include('activities.activity_li_post', ['activity' => $activity])
        </ul>
        <h2 class="right-line">Commentaires</h2>
    </div>

@stop