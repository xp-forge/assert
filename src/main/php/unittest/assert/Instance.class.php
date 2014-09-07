<?php namespace unittest\assert;

class Instance extends Condition {
  protected $type;

  public function __construct($type) {
    $this->type= $type;
  }

  public function matches($value) {
    return $this->type->isInstance($value);
  }

  public function describe($value, $positive) {
    return sprintf(
      '%s %s %s', 
      Value::stringOf($value),
      $positive ? 'is an instance of' : 'is not an instance of',
      $this->type->toString()
    );
  }
}