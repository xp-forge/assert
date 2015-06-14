<?php namespace unittest\assert;

use lang\Throwable;
use unittest\AssertionFailedError;

class All extends \lang\Object {

  public static function of($func) {
    $failed= Assertions::enter(new AssertionsFailed());

    try {
      $func();
    } catch (Throwable $e) {
      $failed->add(new AssertionFailedError('Caught '.$e->compoundMessage()));
    }

    Assertions::leave();
    $failed->raiseIf();
  }
}