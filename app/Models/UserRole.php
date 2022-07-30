<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'role_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function role() {
        return $this->belongsTo('App\Models\Role');
    }
}
