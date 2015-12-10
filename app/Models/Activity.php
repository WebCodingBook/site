<?php

namespace WebCoding\Models;

use Date;
use Illuminate\Database\Eloquent\Model;
use WebCoding\Presenters\ActivityPresenter;

class Activity extends Model
{
    use ActivityPresenter;

    protected $table = 'activities';

    protected $fillable = ['type', 'content'];

    /**
     * Evènements
     */
    public static function boot()
    {
        parent::boot();

        // A la suppression d'une activité...
        Activity::deleting(function($activity) {
            //  On supprime les likes
            $activity->likes()->delete();

            //  On supprime les likes des commentaires associés
            foreach( $activity->comments as $comment ) {
                $comment->likes()->delete();
            }
        });
    }

    // ----------------------------------//
    //------------ Relations ------------//
    // ----------------------------------//

    /**
     * Utilisateur lié à l'activité
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Action liée à l'activité
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    /**
     * Commentaires liées à l'activité
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(ActivityComment::class);
    }

    /**
     * Likes associés à l'activité
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'like');
    }
}
