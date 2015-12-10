<?php
namespace WebCoding\Repositories;

use WebCoding\Models\User;
use WebCoding\Models\Like;
use WebCoding\Models\Activity;

/**
 * Class UserRepository
 * @package WebCoding\Repositories
 */
class LikeRepository extends Repository
{
    /**
     * LikeRepository constructor.
     * @param Like $like
     */
    public function __construct(Like $like)
    {
        $this->model = $like;
    }

    /**
     * Retourne l'id d'un "like" en fonction de l'activité
     *
     * @param User $user
     * @param Activity $activity
     * @return mixed
     */
    public function getLikeByActivityId(User $user, Activity $activity)
    {
        return Like::where('user_id',$user->id)
            ->where('like_id', $activity->id)
            ->where('like_type', get_class($activity))
            ->first();
    }
}