<?php namespace unittest\assert;

abstract class Assert extends \lang\Object {

  /**
   * Entry point
   *
   * @param  var $value
   * @return unittest.assert.Value
   */
  public static function that($value) {
    return Assertions::of($value);
  }
}