<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Planet
 * @package App
 */
class Planet extends Model
{
    protected $fillable = ['planet_id'];

    /**
     * Get the planets - Planets normaly has many people
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function People()
    {
        return $this->hasMany('App\People', 'homeworld', 'planet_id');
    }
}
