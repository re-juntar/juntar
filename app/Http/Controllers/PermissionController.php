<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    function isAdmin()
    {
        $admin = false;
        if (isset(Auth::user()->id)) {
            $userId = Auth::user()->id;

            $role = UserRole::where('user_id', '=', $userId)->first();
            if ($role->role_id <= 3) {
                $admin = true;
            }
        }

        return ['admin' => $admin];
    }

    function isLogged()
    {
        $logged = false;
        $userId = Auth::user()->id;

        $user = User::findOrFail($userId);

        if ($user->id) {
            $logged = true;
        }

        return $logged;
    }
}
