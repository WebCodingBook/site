<?php

namespace WebCoding\Policies;

use WebCoding\Models\User;
use WebCoding\Models\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

class LikePolicy
{
    use HandlesAuthorization;

    /**
     * L'auteur et ses amis peuvent liker une publication
     *
     * @param User $user
     * @param Activity $activity
     * @return bool
     */
    public function like(User $user, Activity $activity)
    {
        return $user->id != $activity->user->id && !$user->isFriendWith($activity->user);
    }
}
