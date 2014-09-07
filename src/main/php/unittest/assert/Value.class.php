<?php namespace unittest\assert;

use util\Objects;
use unittest\AssertionFailedError;
use lang\types\ArrayList;
use lang\types\String;

class Value extends \lang\Object {
  protected $value;
  protected $verify= [];

  public function __construct($value) {
    $this->value= $value;
  }

  public static function of($value) {
    if (is_array($value)) {
      return new ArrayPrimitiveValue($value);
    } else if (is_string($value)) {
      return new StringPrimitiveValue($value);
    } else if ($value instanceof ArrayList) {
      return new ArrayValue($value);
    } else if ($value instanceof String) {
      return new StringValue($value);
    } else {
      return new Value($value);
    }
  }

  public function verify($failed) {
    foreach ($this->verify as $verify) {
      $verify($failed);
    }
    return $failed;
  }

  public function is(Condition $condition) {
    $this->verify[]= function($failed) use($condition) {
      if (!$condition->matches($this->value)) {
        $failed->add(new AssertionFailedError('Failed to verify that '.$condition->describe($this->value, true)));
      }
    };
    return $this;
  }

  public function isNot(Condition $condition) {
    $this->verify[]= function($failed) use($condition) {
      if ($condition->matches($this->value)) {
        $failed->add(new AssertionFailedError('Failed to verify that '.$condition->describe($this->value, false)));
      }
    };
    return $this;
  }

  public function isEqualTo($compare) {
    return $this->is(new Equals($compare));
  }

  public function isNotEqualTo($compare) {
    return $this->isNot(new Equals($compare));
  }

  public function isNull() {
    return $this->is(new Identical(null));
  }

  public function isTrue() {
    return $this->is(new Identical(true));
  }

  public function isFalse() {
    return $this->is(new Identical(false));
  }

  public function isIn($enumerable) {
    return $this->is(new ContainedIn($enumerable));
  }

  public function isNotIn($enumerable) {
    return $this->isNot(new ContainedIn($enumerable));
  }
}