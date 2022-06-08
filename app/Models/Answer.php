<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    public function inscription()
    {
        return $this->belongsTo('App\Models\Inscription');
    }
}
