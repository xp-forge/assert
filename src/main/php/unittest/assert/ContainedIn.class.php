<?php namespace unittest\assert;

class ContainedIn extends Condition {
  protected $enumerable;

  public function __construct($enumerable) {
    $this->enumerable= $enumerable;
  }

  public function matches($value) {
    foreach ($this->enumerable as $element) {
      if ($element === $value) return true;
    }
    return false;
  }

  public function describe($value, $positive) {
    return sprintf(
      '%s %s %s', 
      Value::stringOf($value),
      $positive ? 'is contained in' : 'is not contained in',
      Value::stringOf($this->enumerable)
    );
  }
}