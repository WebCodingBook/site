<?php

namespace WebCoding\Presenters;

use Date;
use Gravatar;

trait UserPresenter
{
    /**
     * Retourne le nom complet d'un utilisateur (si possible)
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if( $this->firstname && $this->lastname ) {
            return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
        }
        return ucfirst($this->username);
    }

    /**
     * Retourne le prénom ou le pseudonyme d'un utilisateur
     *
     * @return string
     */
    public function getNameAttribute()
    {
        if( empty($this->lastname) ) {
            return ucfirst($this->username);
        }
        return ucfirst($this->lastname);
    }

    /**
     * Retourne l'avatar d'un membre
     *
     * @param string $size
     * @return string
     */
    public function avatar($size = 'default')
    {
        if( Gravatar::exists($this->email) ) {
            return Gravatar::get($this->email, $size);
        }
        return asset('images/anonymous.jpg');
    }

    /**
     * Informations minimalistes pour le profil
     *
     * @return mixed|string
     */
    public function getProfessionalAttribute()
    {
        if( !empty($this->location) && !empty($this->job) ) {
            return $this->location . ', ' . $this->job;
        } else if( !empty($this->location) && empty($this->job) ) {
            return $this->location;
        } else if( empty($this->location) && !empty($this->job) ) {
            return $this->job;
        } else {
            return 'Inscrit depuis le ' .$this->getCreatedAtAttribute($this->created_at);
        }
    }
}