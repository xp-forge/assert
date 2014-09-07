<?php namespace unittest\assert;

class Predicate extends \lang\Object implements Condition {
  protected $method;
  protected $arg;

  public function __construct($method, $arg) {
    $this->method= $method;
    $this->arg= $arg;
  }

  public function matches($value) {
    return $value->{$this->method}($this->arg);
  }
}