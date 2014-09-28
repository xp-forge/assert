<?php namespace unittest\assert;

use util\Objects;

class ArrayValue extends Value {

  static function __static() { }

  public function hasSize($size) {
    return $this->is(new Match(
      function($value) use($size) { return $value->length === $size; },
      ['%s does not have a size of '.$size, '%s has a size of '.$size]
    ));
  }

  public function contains($element) {
    return $this->is(new Predicate('contains', $element, [
      '%s does not contain %s',
      '%s contains %s',
    ]));
  }

  public function doesNotContain($element) {
    return $this->isNot(new Predicate('contains', $element, [
      '%s does not contain %s',
      '%s contains %s',
    ]));
  }

  public function startsWith($element) {
    $rep= Value::stringOf($element);
    return $this->is(new Match(
      function($value) use($element) {
        return $value->length > 0 && Objects::equal($value[0], $element);
      },
      ['%s does not start with '.$rep, '%s starts with '.$rep]
    ));
  }

  public function endsWith($element) {
    $rep= Value::stringOf($element);
    return $this->is(new Match(
      function($value) use($element) {
        return $value->length > 0 && Objects::equal($value[$value->length - 1], $element);
      },
      ['%s does not end with '.$rep, '%s ends with '.$rep]
    ));
  }

  /**
   * Extract a given arg
   *
   * @param  var $arg
   * @return self
   */
  public function extracting($arg) {
    $return= [];
    foreach ($this->value as $value) {
      $return[]= self::of($value)->extracting($arg)->value;
    }
    return self::of($return);
  }
}