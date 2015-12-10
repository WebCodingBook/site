<?php

namespace WebCoding\Http\Controllers\Timeline;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\JsonResponse;
use WebCoding\Http\Requests;
use WebCoding\Http\Controllers\Controller;

use WebCoding\Models\Activity;
use WebCoding\Models\ActivityComment;

class ActivitiesCommentsController extends Controller
{
    /**
     * Récupère les commentaires d'une activité
     *
     * @param $activity
     * @return View
     */
    public function comments($activity)
    {
        $act = Activity::findOrFail($activity);
        $comments = ActivityComment::with('user')->where('activity_id', $act->id)->get();

        return view('activities.comments', compact('comments', 'act'));
    }

    /**
     * Ajoute un nouveau commentaire pour une activité
     *
     * @param Requests\PostActivityRequest $request
     * @return JsonResponse
     */
    public function store(Requests\PostActivityRequest $request)
    {
        $activity = Activity::findOrFail($request->input('activity_id'));
        $this->authorize('comment', $activity);

        $comment = $activity->comments()->create([
            'user_id'   =>  $request->user()->id,
            'content'   =>  $request->input('content'),
        ]);

        return view('activities.comment', compact('comment'));
    }

    /**
     * Met à jour un commentaire
     *
     * @param Requests\PostActivityRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Requests\PostActivityRequest $request, $id)
    {
        $comment = ActivityComment::findOrFail($id);
        $this->authorize('update', $comment);
        $comment->update([
            'content'   =>  $request->input('content'),
        ]);

        return new JsonResponse([
            'id'        =>  $comment->id,
            'comment'   =>  $comment->content
        ]);
    }

    public function destroy($id)
    {
        $comment = ActivityComment::findOrFail($id);
        $commentId = $comment->id;
        $this->authorize('delete', $comment);
        $comment->delete();

        return new JsonResponse([
            'id'        =>  'comment_' . $commentId,
            'status'    =>  'success',
            'message'   =>  'Commentaire supprimé !',
        ]);
    }
}
