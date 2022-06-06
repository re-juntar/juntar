<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;

    public function exhibitors()
    {
        return $this->hasMany('App\Models\PresentationExhibitor');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }
}
