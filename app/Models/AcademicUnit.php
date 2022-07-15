<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicUnit extends Model
{
    use HasFactory;

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
