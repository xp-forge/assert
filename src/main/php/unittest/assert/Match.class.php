<?php namespace unittest\assert;

use lang\Type;

class Match extends \lang\Object implements Condition {
  protected static $PREDICATE;
  protected $function;

  static function __static() {
    self::$PREDICATE= Type::forName('function(var): bool');
  }

  public function __construct($function) {
    $this->function= self::$PREDICATE->cast($function);
  }

  public function matches($value) {
    return $this->function->__invoke($value);
  }
}