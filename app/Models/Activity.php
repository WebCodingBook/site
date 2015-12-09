<?php

namespace WebCoding\Models;

use Date;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = ['type', 'content'];

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

    /**
     * Retourne le mois de publication
     *
     * @return mixed
     */
    public function getMonthAttribute()
    {
       return Date::parse($this->created_at)->format('F');
    }

    /**
     * Retourne la date de publication formatée
     *
     * @return mixed
     */
    public function getDateAttribute()
    {
        return Date::parse($this->created_at)->format('d/m/Y');
    }

    public function getTimestampAttribute()
    {
        return Date::parse($this->created_at)->diffForHumans();
    }
}
