<?php namespace unittest\assert;

abstract class Assert {

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
