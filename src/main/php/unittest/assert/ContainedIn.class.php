<?php namespace unittest\assert;

class ContainedIn extends \lang\Object implements Condition {
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
}