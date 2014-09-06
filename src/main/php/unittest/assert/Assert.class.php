<?php namespace unittest\assert;

abstract class Assert extends \lang\Object {

  public static function that($value) {
    return Assertions::verifyThat($value);
  }
}