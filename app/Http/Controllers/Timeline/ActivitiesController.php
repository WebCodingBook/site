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
     *  Aime une activité
     *
     * @param $id
     * @return JsonResponse|JsonReponse
     */
    public function like($id)
    {
        $activity = Activity::findOrFail($id);
        if( $this->activity->like($activity) ) {
            return new JsonResponse(['status' => 'success']);
        } else {
            return new JsonReponse(['status' => 'failed']);
        }
    }

    /**
     * N'aime plus une activité
     *
     * @param $id
     * @return JsonResponse|JsonReponse
     */
    public function unlike($id)
    {
        $activity = Activity::findOrFail($id);
        if( $this->activity->unlike($activity) ) {
            return new JsonResponse(['status' => 'success']);
        } else {
            return new JsonReponse(['status' => 'failed']);
        }
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

        if( $request->ajax() ) {
            return view('activities.activity_li_post', compact('activity'));
        } else {
            alert()->success('Votre publication a été postée ;)');
            return redirect()->route('user.view', ['username' => $request->user()->username]);
        }
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

        if( $request->ajax() ) {
            return new JsonResponse([
                'status'    =>  'success',
                'id'        =>  $activity->id,
                'content'   =>  $activity->content
            ]);
        } else {
            alert()->success('Publication mise à jour !');
            return redirect(route('user.view', ['username' => $request->user()->username]) . '#activity_' . $activity->id);
        }
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
