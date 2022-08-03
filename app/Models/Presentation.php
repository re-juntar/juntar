<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;
    public $fillable = [
        'event_id', 'title',
        'description',
        'date',
        'start_time',
        'end_time',
        'exhibitors',
        'resources_link',
    ];
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    protected function date(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                $return = explode("-", $value);
                return substr($return[2], 0, 2) . "/" . $return[1] . "/" . $return[0];
            }
        );
    }

    protected function startTime(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return substr($value, 0, 5);
            }
        );
    }

    protected function endTime(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return substr($value, 0, 5);
            }
        );
    }
}
