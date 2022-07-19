<?php

namespace App\Models;

use App\Helper\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicUnits extends Model
{
    use HasFactory, Imageable;

    public $fillable = [
        'name',
        'short_name',
        'image_logo',
    ];

    public function endorsementRequest()
    {
        return $this->hasMany('App\Models\EndorsementRequest');
    }
}
