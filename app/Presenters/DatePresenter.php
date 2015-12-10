<?php
namespace WebCoding\Presenters;

use Date;

trait DatePresenter
{
    /**
     * Date formatée
     *
     * @param $value
     * @return mixed
     */
    public function getCreatedAtAttribute($value)
    {
       return Date::parse($value)->format('l j F Y');
    }

    /**
     * Différence now() - date
     *
     * @param $value
     * @return mixed
     */
    public function getUpdatedAtAttribute($value)
    {
        return Date::parse($value)->diffForHumans();
    }
}