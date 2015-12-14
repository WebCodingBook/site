<?php

namespace WebCoding\Models;

use Illuminate\Database\Eloquent\Model;
use WebCoding\Presenters\DatePresenter;

class ActivityComment extends Model
{
    use DatePresenter;

    protected $table = 'activities_comments';

    protected $fillable = ['content', 'user_id', 'activity_id', 'created_at', 'updated_at'];

    /**
     * Évènements
     */
    public static function boot()
    {
        parent::boot();

        //  On supprime les likes du commentaire
        ActivityComment::deleting(function($comment) {
            $comment->likes()->delete();
        });
    }

    /**
     * Utilisateur associé au commentaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Activité associée au commentaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Likes associés au commentaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'like');
    }
}
