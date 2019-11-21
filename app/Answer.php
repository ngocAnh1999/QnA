<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public function question() {
        return $this->belongsTo(Question::class);
    }
    public function pickedByUsers() {
        return $this->belongsToMany(User::class)->withTimestamps();
    } 
}
