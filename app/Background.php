<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    /**
     * Get the posters where the background is used.
     */
    public function posters()
    {
        return $this->hasMany('App\Poster');
    }
}
