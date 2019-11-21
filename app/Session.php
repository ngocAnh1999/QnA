<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function sessionType() {
        return $this->belongsTo(SessionType::class);
    }
    public function questions() {
        return $this->hasMany(Question::class);
    }
}
