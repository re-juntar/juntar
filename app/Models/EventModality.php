<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModality extends Model
{
    use HasFactory;

    public function events()
    {
        return $this->hasOne('App\Models\Event');
    }
}
