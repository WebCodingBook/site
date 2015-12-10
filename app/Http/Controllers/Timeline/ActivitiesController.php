<?php

namespace WebCoding\Http\Controllers\Timeline;

use Date;
use Illuminate\Http\Request;
use WebCoding\Http\Requests;
use Illuminate\Http\JsonResponse;
use WebCoding\Http\Controllers\Controller as Controller;

//  Models
use WebCoding\Models\Activity;
use WebCoding\Repositories\ActivityRepository;

class ActivitiesController extends Controller
{
    protected $activity;

    public function __construct(ActivityRepository $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Affichage d'une activité
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $activity = Activity::with('user')->findOrFail($id);
        return view('activities.show', compact('activity'));
    }

    /**
     * Enregistre une nouvelle activité
     *
     * @param Requests\postActivityRequest $request
     * @return JsonResponse
     */
    public function store(Requests\PostActivityRequest $request)
    {
        $activity = $request->user()->activities()->create([
            'content'   =>  $request->input('content'),
            'type'      =>  'status'
        ]);

        return view('activities.activity_li_post', compact('activity'));
    }

    /**
     * Met à jour une activité
     *
     * @param Requests\postActivityRequest $request
     * @param $activity
     * @return JsonResponse
     */
    public function update(Requests\PostActivityRequest $request, $activity)
    {
        $activity = Activity::findOrFail($activity);
        $this->authorize('update', $activity);
        $activity->update([
            'content'   =>  $request->input('content')
        ]);

        return new JsonResponse([
            'status'    =>  'success',
            'id'        =>  $activity->id,
            'content'   =>  $activity->content
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        $activityId = $activity->id;
        $this->authorize('delete', $activity);

        return new JsonResponse([
            'id'        => 'activity_' . $activityId,
            'status'    => 'success',
            'message'   => 'La publication a été supprimée !',
        ]);
    }
}
