<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    //
    public function sessions() {
        return $this->hasMany(Session::class);
    }
}
