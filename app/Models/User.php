<?php

namespace WebCoding\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use WebCoding\Presenters\DatePresenter;
use WebCoding\Presenters\UserPresenter;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, DatePresenter, UserPresenter;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'firstname', 'lastname', 'city', 'country', 'department', 'birthday', 'job', 'avatar', 'cover', 'status', 'gender', 'facebook_id', 'google_id', 'twitter_id', 'linkedin_id', 'github_id', 'display_full_name', 'display_in_search', 'can_be_contacted'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // ----------------------------------//
    //------------ Relations ------------//
    // ----------------------------------//

    /**
     * Relation One To Many avec les commentaires
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function newsComments()
    {
        return $this->hasMany(NewsComments::class);
    }

    /**
     * Relation One To Many avec les news
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }

    /**
     * Actions liées au membre
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    /**
     * Publications du membre
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Commentaires de publications liés à l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activitiesComs()
    {
        return $this->hasMany(ActivityComment::class);
    }

    /**
     * Likes associés à l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    // ----------------------------------//
    //------------ Likes Relations ------//
    // ----------------------------------//

    /**
     * Détermine si l'utilisateur a déjà aimé une activité ou pas
     *
     * @param Activity $activity
     * @return mixed
     */
    public function hasLikedActivity(Activity $activity)
    {
        return $activity->likes
            ->where('like_id', $activity->id)
            ->where('like_type', get_class($activity))
            ->where('user_id', $this->id)
            ->count();
    }

    /**
     * Détermine si l'utilisateur a déjà aimé un commentaire ou pas
     *
     * @param ActivityComment $comment
     * @return mixed
     */
    public function hasLikedActivityComment(ActivityComment $comment)
    {
        return $comment->likes
            ->where('like_id', $comment->id)
            ->where('like_type', get_class($comment))
            ->where('user_id', $this->id)
            ->count();
    }

    // ----------------------------------//
    //------------ Friends Relations ----//
    // ----------------------------------//

    /**
     * Relations avec "Mes amis"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    /**
     * Relations "les amis de"
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    /**
     * Mes amis validés
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge(
            $this->friendOf()->wherePivot('accepted', true)->get()
        );
    }

    /**
     * Derniers amis ajoutés
     *
     * @param $limit
     * @return mixed
     */
    public function lastFriends($limit)
    {
        return $this->friendsOfMine()
            ->wherePivot('accepted', true)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->merge(
                $this->friendOf()
                    ->wherePivot('accepted', true)
                    ->orderBy('created_at', 'desc')
                    ->limit($limit)
                    ->get()
            );
    }

    /**
     * Requêtes d'amis
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    /**
     * Demandes envoyées
     */
    public function friendRequestPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    // ----------------------------------//
    //------------ Friends process ------//
    // ----------------------------------//

    /**
     * Détermine si l'utilisateur a une requête d'un utilisateur
     *
     * @param User $user
     * @return bool
     */
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    /**
     * Détermine si l'utilisateur a une requête
     *
     * @param User $user
     * @return bool
     */
    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    /**
     * Ajoute un utilisateur à la demande d'ami
     *
     * @param User $user
     */
    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    /**
     * Accepte la requête d'un utilisateur
     *
     * @param User $user
     */
    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted'  =>  true
        ]);
    }

    /**
     * Détermine si un utilisateur est ami avec un autre
     *
     * @param User $user
     * @return bool
     */
    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }


}
