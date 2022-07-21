<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function answer()
    {
        return $this->hasOne('App\Models\Answer');
    }

    public function store(Event $event, $userid){
        
    }


}
