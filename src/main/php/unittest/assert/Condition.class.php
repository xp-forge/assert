<?php namespace unittest\assert;

use util\Objects;

abstract class Condition extends \lang\Object {

  public abstract function matches($value);

  public static function stringOf($value) {
    return null === $value ? 'null' : Objects::stringOf($value);
  }

  public function describe($value, $positive) {
    return self::stringOf($value).' '.($positive ? 'matches' : 'does not match');
  }
}