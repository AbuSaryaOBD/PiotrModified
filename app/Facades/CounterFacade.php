<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static int increment()
 */
class CounterFacade extends Facade
{
  public static function getFacadeAccessor()
  {
    return 'App\Contracts\CounterContract';
  }
}