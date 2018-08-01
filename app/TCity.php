<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TCity extends Model
{
    protected $table = "tcities";

    public function city()
    {
        return $this->belongsTo(TState::class, 'state_id');
    }
}
