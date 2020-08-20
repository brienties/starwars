<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class People
 * @package App
 */
class People extends Model
{
    protected $fillable = ['people_id'];

    /**
     * Get the homeworld from the planets - People has normaly one homeworld
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function homeworlds()
    {
        return $this->hasOne('App\Planet', 'planet_id', 'homeworld');
    }

    /**
     * Get the Species - People has normaly one species
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function species()
    {
        return $this->hasOne('App\Species', 'species_id', 'species');
    }
}
