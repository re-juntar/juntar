<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\EventCategory');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\EventStatus');
    }

    public function modality()
    {
        return $this->belongsTo('App\Models\EventModality');
    }

    public function inscriptions()
    {
        return $this->hasMany('App\Models\Inscription');
    }

    public function presentations()
    {
        return $this->hasMany('App\Models\Presentation');
    }

    public function endorsements()
    {
        return $this->hasMany('App\Models\EndorsementRequest');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
}
