<?php namespace unittest\assert;

use lang\Throwable;

class All extends \lang\Object {

  public static function of($func) {
    Assertions::enter(new AssertionsFailed());
    try {
      $func();
      Assertions::leave()->raiseIf();
    } catch (Throwable $e) {
      Assertions::leave();
      throw $e;
    }
  }
}