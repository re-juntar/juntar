<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        //
    }

    public function update(Request $request)
    {
        $role = Role::find($request->id);
        if ($role) {
            $role->updateRole($request);
            return redirect()->to('/gestionar/roles');
        } else abort(404);
    }


    // public function create(Request $request )
    // {

    //     $request->validate([
    //    'name' => 'required|max:200|string',
    //    'description' => 'required',
    //  ]);
    //     Role::create($request);
    //    return redirect()->to('/gestionar/roles');   
    // }
}
