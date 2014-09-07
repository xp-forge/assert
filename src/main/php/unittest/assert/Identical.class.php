<?php namespace unittest\assert;

class Identical extends \lang\Object implements Condition {
  protected $value;

  public function __construct($value) {
    $this->value= $value;
  }

  public function matches($value) {
    return $this->value === $value;
  }
}