<?php

namespace WebCoding\Http\Controllers\Timeline;

use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\UnauthorizedException;

use Auth;
use WebCoding\Http\Controllers\Controller;

use WebCoding\Models\Activity;
use WebCoding\Models\ActivityComment;
use WebCoding\Models\Like;
use WebCoding\Repositories\LikeRepository;

class LikesController extends Controller
{
    protected $repository;

    public function __construct(LikeRepository $likeRepository)
    {
        $this->repository = $likeRepository;
    }

    /**
     * Permet d'aimer une publication
     *
     * @param $id
     * @return JsonResponse
     */
    public function likeActivity($id)
    {
        $activity = Activity::findOrFail($id);

        if( Auth::user()->id != $activity->user->id && !Auth::user()->isFriendWith($activity->user) ) {
            return new UnauthorizedException();
        }

        //  On check que l'utilisateur n'a pas liké la publication
        if( Auth::user()->hasLikedActivity($activity) ) {
            $likeToRemove = $this->repository->getLikeByActivityId(Auth::user(), $activity);
            $removeLike = Like::findOrFail($likeToRemove->id);
            $removeLike->delete();

            $type = 'remove';
        } else {
            /*
            $like = $activity->likes()->create([]);
            Auth::user()->likes()->save($like);
            */
            $activity->likes()->create([
                'user_id'   =>  Auth::user()->id,
            ]);
            $type = 'add';
        }

        return new JsonResponse([
            'status'    =>  'success',
            'type'      =>  $type
        ]);
    }

    public function likeActivityComment($id)
    {
        $comment = ActivityComment::findOrFail($id);
        if( Auth::user()->id != $comment->user->id && !Auth::user()->isFriendWith($comment->user) ) {
            return new UnauthorizedException();
        }

        //  On check que l'utilisateur n'a pas liké le commentaire
        if( Auth::user()->hasLikedActivityComment($comment) ) {
            $likeToRemove = $this->repository->getLikeByActivityCommentId(Auth::user(), $comment);
            $removeLike = Like::findOrFail($likeToRemove->id);
            $removeLike->delete();

            $type = 'remove';
        } else {
            $comment->likes()->create([
                'user_id'   =>  Auth::user()->id,
            ]);
            $type = 'add';
        }

        return new JsonResponse([
            'status'    =>  'success',
            'type'      =>  $type
        ]);
    }
}
