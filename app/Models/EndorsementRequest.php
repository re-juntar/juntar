<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndorsementRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'event_id',
        'user_id',
    ];

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
