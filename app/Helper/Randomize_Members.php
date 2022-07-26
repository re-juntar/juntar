<?php

namespace App\Helper;

trait Randomize_Members
{
  public function randomize_members($arr)
  {
    $keys = array_keys($arr);

    shuffle($keys);

    foreach ($keys as $key) {
      $new[$key] = $arr[$key];
    }

    $arr = $new;

    return $arr;
  }
}
