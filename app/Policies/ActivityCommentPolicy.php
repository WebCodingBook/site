<?php

namespace WebCoding\Policies;

use Auth;
use Request;
use Illuminate\Auth\Access\HandlesAuthorization;
use WebCoding\Models\Activity;
use WebCoding\Models\ActivityComment;
use WebCoding\Models\User;

class ActivityCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Est ce qu'un utilisateur peut commenter le statut d'un autre ?
     *
     * @param User $user
     * @param Activity $activity
     * @return bool
     */
    public function create(User $user, Activity $activity )
    {
        return ($user->isFriendWith($activity->user)) || ($user->id === $activity->user->id);
    }

    /**
     * Seul l'auteur peut éditer un commentaire
     *
     * @param User $user
     * @param ActivityComment $comment
     * @return bool
     */
    public function update(User $user, ActivityComment $comment)
    {
        return $user->id === $comment->user->id;
    }

    /**
     * Seul l'auteur peut supprimer un commentaire
     *
     * @param User $user
     * @param ActivityComment $comment
     * @return bool
     */
    public function delete(User $user, ActivityComment $comment)
    {
        return $user->id === $comment->user->id;
    }
}
