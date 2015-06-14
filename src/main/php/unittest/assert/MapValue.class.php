<?php namespace unittest\assert;

use util\Objects;

class MapValue extends Value {

  public function hasSize($size) {
    return $this->is(new Match(
      function($value) use($size) { return sizeof($this->value) === $size; },
      ['%s does not have a size of '.$size, '%s has a size of '.$size]
    ));
  }

  public function isEmpty() {
    return $this->is(new Match(
      function($value) { return empty($this->value); },
      ['%s is not empty', '%s is empty']
    ));
  }

  public function contains($element) {
    $rep= Condition::stringOf($element);
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
    $rep= Condition::stringOf($element);
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
          throw new \lang\IndexOutOfBoundsException('Cannot extract "'.$key.'" from '.Condition::stringOf($this->value));
        }
        $value[]= $this->value[$key];
      }
      return self::of($value);
    } else {
      if (!array_key_exists($arg, $this->value)) {
        throw new \lang\IndexOutOfBoundsException('Cannot extract "'.$arg.'" from '.Condition::stringOf($this->value));
      }
      return self::of($this->value[$arg]);
    }
  }
}