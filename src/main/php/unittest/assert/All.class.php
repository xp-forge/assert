<?php namespace unittest\assert;

use lang\Throwable;

abstract class All extends \lang\Object {

  /**
   * Runs all assertions in the block
   *
   * @param  function(): void $block
   * @return void
   * @throws unittest.AssertionFailedError
   */
  public static function of($block) {
    Assertions::enter(new AssertionsFailed());
    try {
      $block();
      Assertions::leave()->raiseIf();
    } catch (Throwable $e) {
      Assertions::leave();
      throw $e;
    }
  }
}