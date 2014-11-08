<?php namespace unittest\assert;

use util\Objects;

class MapPrimitiveValue extends Value {

  static function __static() { }

  public function hasSize($size) {
    return $this->is(new Match(
      function($value) use($size) { return sizeof($this->value) === $size; },
      ['%s does not have a length of '.$size, '%s has a size of '.$size]
    ));
  }

  public function contains($element) {
    $rep= Value::stringOf($element);
    return $this->is(new Match(
      function($value) use($element) {
        foreach ($this->value as $value) {
          if ($value === $element) return true;
        }
        return false;
      },
      ['%s does not contain '.$rep, '%s contains '.$rep]
    ));
  }

  public function doesNotContain($element) {
    $rep= Value::stringOf($element);
    return $this->isNot(new Match(
      function($value) use($element) {
        foreach ($this->value as $value) {
          if ($value === $element) return true;
        }
        return false;
      },
      ['%s does not contain '.$rep, '%s contains '.$rep]
    ));
  }

  /**
   * Extract a given arg
   *
   * @param  var $arg
   * @return self
   */
  public function extracting($arg) {
    if (is_array($arg)) {
      $value= [];
      foreach ($arg as $key) {
        if (!array_key_exists($key, $this->value)) {
          throw new \lang\IndexOutOfBoundsException('Cannot extract "'.$key.'" from '.Value::stringOf($this->value));
        }
        $value[]= $this->value[$key];
      }
      return self::of($value);
    } else {
      if (!array_key_exists($arg, $this->value)) {
        throw new \lang\IndexOutOfBoundsException('Cannot extract "'.$arg.'" from '.Value::stringOf($this->value));
      }
      return self::of($this->value[$arg]);
    }
  }
}