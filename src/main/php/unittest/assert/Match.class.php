<?php namespace unittest\assert;

use lang\Type;

class Match extends Condition {
  protected static $PREDICATE;
  protected $function;
  protected $format;

  static function __static() {
    self::$PREDICATE= Type::forName('function(var): bool');
  }

  public function __construct($function, $format= ['%s does not match', '%s matches']) {
    $this->function= self::$PREDICATE->cast($function);
    $this->format= $format;
  }

  public function matches($value) {
    return $this->function->__invoke($value);
  }

  public function describe($value, $positive) {
    return sprintf($this->format[$positive], self::stringOf($value));
  }
}