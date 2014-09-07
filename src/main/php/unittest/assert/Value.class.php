<?php namespace unittest\assert;

use util\Objects;

class Value extends \lang\Object {
  protected $value;
  protected $verify= [];

  public function __construct($value, $verify) {
    $this->value= $value;
    $this->verify= $verify;
  }

  public function is(Condition $condition) {
    $this->verify[]= function() use($condition) {
      return $condition->matches($this->value);
    };
    return $this;
  }

  public function isNot(Condition $condition) {
    $this->verify[]= function() use($condition) {
      return !$condition->matches($this->value);
    };
    return $this;
  }

  public function isEqualTo($compare) {
    $this->verify[]= function() use($compare) {
      return Objects::equal($this->value, $compare);
    };
    return $this;
  }

  public function isNotEqualTo($compare) {
    $this->verify[]= function() use($compare) {
      return !Objects::equal($this->value, $compare);
    };
    return $this;
  }

  public function isNull() {
    $this->verify[]= function() {
      return null === $this->value;
    };
    return $this;
  }

  public function isTrue() {
    $this->verify[]= function() {
      return true === $this->value;
    };
    return $this;
  }

  public function isFalse() {
    $this->verify[]= function() {
      return false === $this->value;
    };
    return $this;
  }

  public function isIn($enumerable) {
    $this->verify[]= function() use($enumerable) {
      foreach ($enumerable as $value) {
        if ($value === $this->value) return true;
      }
      return false;
    };
    return $this;
  }

  public function isNotIn($enumerable) {
    $this->verify[]= function() use($enumerable) {
      foreach ($enumerable as $value) {
        if ($value === $this->value) return false;
      }
      return true;
    };
    return $this;
  }
}