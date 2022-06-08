<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function event()
    {
        return $this->belongsTo('App\Model\Event');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }
}
