<?php

namespace App\Models;

use App\Helper\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory, Imageable;

    public function eventCategory()
    {
        return $this->belongsTo('App\Models\EventCategory');
    }

    public function eventStatus()
    {
        return $this->belongsTo('App\Models\EventStatus');
    }

    public function eventModality()
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

    public function organizers()
    {
        return $this->hasOne('App\Models\Organizer');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function storeEvent($request)
    {
        $this->user_id = Auth::user()->id;
        $this->name = $request->name;
        $this->short_name = $request['short-name'];
        $this->description = $request->description;
        $this->venue = $request->place;
        $this->event_category_id = $request->category;
        $this->event_modality_id = $request->modality;
        $this->event_status_id = 4;
        $this->start_date = $request['start-date'];
        $this->end_date = $request['end-date'];
        $this->endorsed = 0;

        if (isset($request['amount-of-participants'])) {
            $this->capacity = $request['amount-of-participants'];
        } else {
            $this->capacity = -1;
        }

        if(isset($request->meet)) {
            $this->meeting_link = $request->meet;
        }

        if(isset($request->place)) {
            $this->venue = $request->place;
        }

        $this->pre_registration = $request->preinscription;
        if($request->preinscription) {
            $this->inscription_end_date = $request['preinscription-date'];
        }

        $this->save();

        return $this;
    }

    public function updateEvent($request) {
        $this->name = $request->name;
        $this->short_name = $request['short-name'];
        $this->description = $request->description;
        $this->venue = $request->place;
        $this->event_category_id = $request->category;
        $this->event_modality_id = $request->modality;
        $this->event_status_id = 1;
        $this->start_date = $request['start-date'];
        $this->end_date = $request['end-date'];
        $this->endorsed = 0;

        if (isset($request['participants-limit'])) {
            $this->capacity = $request['participants-limit'];
        } else {
            $this->capacity = -1;
        }

        if(isset($request->meet)) {
            $this->meeting_link = $request->meet;
        }

        if(isset($request->place)) {
            $this->venue = $request->place;
        }

        $this->pre_registration = $request->preinscription;
        if($request->preinscription) {
            $this->inscription_end_date = $request['preinscription-date'];
        }


        $this->save();

        return $this;
    }
}
