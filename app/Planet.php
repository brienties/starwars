<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    protected $table    = 'peoples';
    protected $fillable = ['planet_id'];
}
