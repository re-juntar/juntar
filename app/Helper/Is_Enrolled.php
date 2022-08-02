<?php

namespace App\Helper;

use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;

trait Is_Enrolled
{
  public function is_enrolled($eventId)
  {
    $arrEnrolledUser = [];
    if (!is_null(Auth::user())) {
      $arrEnrolledUser = Inscription::join('users', 'users.id', '=', 'inscriptions.user_id')
        ->where('inscriptions.event_id', $eventId)
        ->where('inscriptions.user_id', '=', Auth::user()->id)
        ->get('inscriptions.id');
    }
    return $arrEnrolledUser;
  }
}
