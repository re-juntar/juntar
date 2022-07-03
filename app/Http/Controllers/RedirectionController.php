<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectionController extends Controller
{
    public function externalUrl($url)
    {
        return Redirect::away($url);
    }
}
