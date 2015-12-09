<?php

namespace WebCoding\Models;

use Illuminate\Database\Eloquent\Model;

class ActionModel extends Model
{
    protected $fillable = ['action', 'user_id', 'activity_id', 'ip', 'created_at', 'updated_at'];

    /**
     * Utilisateur lié à l'action
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Activité liée à l'action
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
