<?php

namespace WebCoding\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Retourne le nom de la table
     *
     * @return mixed
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
