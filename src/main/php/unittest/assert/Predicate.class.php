<?php namespace unittest\assert;

class Predicate extends Condition {
  protected $method;
  protected $arg;
  protected $format;

  public function __construct($method, $arg, $format= ['%s does not match %s', '%s matches %s']) {
    $this->method= $method;
    $this->arg= $arg;
    $this->format= $format;
  }

  public function matches($value) {
    return $value->{$this->method}($this->arg);
  }

  public function describe($value, $positive) {
    return sprintf($this->format[$positive], self::stringOf($value), self::stringOf($this->arg));
  }
}
