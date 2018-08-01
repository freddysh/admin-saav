<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TCountry extends Model
{
    protected $table = "tcountries";
    public function state()
    {
        return $this->hasMany(TState::class, 'country_id');
    }
}
