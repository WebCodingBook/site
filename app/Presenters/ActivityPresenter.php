<?php

namespace WebCoding\Presenters;

use Date;

trait ActivityPresenter
{
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