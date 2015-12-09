<?php

namespace WebCoding\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $fillable = ['user_id', 'likeable_id', 'likeable_type'];

    /**
     * Relation polymorphique
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function like()
    {
        return $this->morphTo();
    }

    /**
     * Utilisateurs associés
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
