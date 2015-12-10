<?php

namespace WebCoding\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityComment extends Model
{
    protected $table = 'activities_comments';

    protected $fillable = ['content', 'user_id', 'activity_id', 'created_at', 'updated_at'];

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
