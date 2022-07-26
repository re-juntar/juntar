<?php

namespace App\Http\Controllers;

use App\Models\UserRole;

class UserRoleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $userRole = new UserRole();
        $userRole->user_id = $id;
        $userRole->role_id = 4;

        $userRole->save();
    }
}
