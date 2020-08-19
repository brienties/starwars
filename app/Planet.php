<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    protected $fillable = ['planet_id'];

    public function People()
    {
        return $this->hasMany('App\People', 'homeworld', 'planet_id');
    }
}
