<?php namespace unittest\assert;

use util\Objects;

abstract class Condition extends \lang\Object {

  /**
   * Test whether this condition matches a given value
   *
   * @param  var $value
   * @return bool
   */
  public abstract function matches($value);

  /**
   * Describe this condition using a given value
   *
   * @param  var $value
   * @param  bool $positive Whether to use positive ("matches") or negative ("does not match")
   * @return string
   */
  public function describe($value, $positive) {
    return Value::stringOf($value).' '.($positive ? 'matches' : 'does not match');
  }
}