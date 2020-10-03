<?php namespace unittest\assert\unittest;

class Name {
  private $value;

  /** @param string $value */
  public function __construct($value) { $this->value= $value; }

  /** @return string */
  public function value() { return $this->value; }
}
