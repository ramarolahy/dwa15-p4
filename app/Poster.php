<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    /**
     * Get the background used by the poster.
     */
    public function background()
    {
        return $this->belongsTo('App\Background');
    }
}
