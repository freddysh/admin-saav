<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TState extends Model
{
    protected $table = "tstates";
    public function state()
    {
        return $this->belongsTo(TCountry::class, 'country_id');
    }
    public function city()
    {
        return $this->hasMany(TCity::class, 'state_id');
    }
}
