<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    public function session() {
        return $this->belongsTo(Session::class);
    }
    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
