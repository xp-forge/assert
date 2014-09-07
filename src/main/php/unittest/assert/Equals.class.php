<?php namespace unittest\assert;

use util\Objects;

class Equals extends \lang\Object implements Condition {
  protected $value;

  public function __construct($value) {
    $this->value= $value;
  }

  public function matches($value) {
    return Objects::equal($this->value, $value);
  }
}