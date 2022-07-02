<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;

    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }

    public function store($request)
    {
        $this->description = $request['description'];
        $this->save();

        return $this;
    }

    public function updateEventCategory($request)
    {
        $this->description = $request->description;
        $this->save();

        return $this;
    }
}
