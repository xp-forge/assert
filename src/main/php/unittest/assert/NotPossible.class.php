<?php namespace unittest\assert;

class NotPossible extends Condition {
  protected $message;

  public function __construct($message) {
    $this->message= $message;
  }

  public function matches($value) {
    return false;
  }

  public function describe($value, $positive) {
    return sprintf(self::stringOf($value).' '.$this->message);
  }
}
