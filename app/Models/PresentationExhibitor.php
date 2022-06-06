<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentationExhibitor extends Model
{
    use HasFactory;

    public function presentation()
    {
        return $this->belongsTo('App\Models\Presentation');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
