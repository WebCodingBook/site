<?php

namespace WebCoding\Policies;

use Auth;
use WebCoding\Models\User;
use WebCoding\Models\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;


class ActivityPolicy
{
    use HandlesAuthorization;

    /**
     * L'auteur et les admins peuvent éditer une publication
     *
     * @param User $user
     * @param Activity $activity
     * @return bool
     */
    public function update(User $user, Activity $activity)
    {
        return $user->id === $activity->user_id;
    }

    /**
     * @param User $user
     * @param Activity $activity
     * @return bool
     */
    public function comment(User $user, Activity $activity)
    {
        return ($user->isFriendWith($activity->user)) || ($user->id === $activity->user->id);
    }

    /**
     * L'auteur et les admins peuvent supprimer une publication
     *
     * @param User $user
     * @param Activity $activity
     * @return bool
     */
    public function delete(User $user, Activity $activity)
    {
        return $user->id === $activity->user_id;
    }
}
