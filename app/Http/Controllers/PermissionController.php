<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    static function isAdmin()
    {
        if (isset(Auth::user()->id)) {
            $userId = Auth::user()->id;
            $role = UserRole::where('user_id', '=', $userId)->first();

            return ($role->role_id <= 2);
        } else return false;
    }

    static function isValidator()
    {
        if (isset(Auth::user()->id)) {
            $userId = Auth::user()->id;
            $role = UserRole::where('user_id', '=', $userId)->first();

            return !($role->role_id > 3);
        } else return false;
    }

    function isLogged()
    {
        $logged = false;

        (!is_null(Auth::user())) ? $logged = true : '';

        return $logged;
    }
}
