<?php

namespace App\Models;

use App\Helper\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory, Imageable;

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

    public function organizers()
    {
        return $this->hasMany('App\Models\Organizer');
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
        $this->pre_registration = $request->preinscription;
        // $this->pre_registration = 0;
        // $this->accreditation_token = $request['accreditation-code'];
        $this->accreditation_token = 1;
        // $this->image_flyer = $paths['flyer'];
        // $this->image_logo = $paths['logo'];

        $this->save();

        return $this;
    }
}
