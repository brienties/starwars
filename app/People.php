<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = ['people_id'];

    /**
     * Get the homeworld from the planets
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function homeworlds()
    {
        return $this->belongsTo('App\Planet', 'planet_id', 'homeworld');
    }

    /**
     * Get the Species
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function species()
    {
        return $this->belongsTo('App\Species', 'species_id', 'species');
    }
}
