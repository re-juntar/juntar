<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;



    public function userRole() {
        return $this->hasOne('App\Models\UserRole');
    }

    public function updateRole($request)
    {
        $this->description = $request["description"];
        $this->name = $request["name"];
        $this->save();
        return $this;
    }

    public function createRole($request)
    {
        $this->description = $request["description"];
        $this->name = $request["name"];
        $this->save();
        return $this;
    }

}
