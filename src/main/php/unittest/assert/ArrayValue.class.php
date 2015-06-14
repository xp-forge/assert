<?php namespace unittest\assert;

use util\Objects;

class ArrayValue extends Value {

  public function hasSize($size) {
    return $this->is(new Match(
      function($value) use($size) { return sizeof($this->value) === $size; },
      ['%s does not have a length of '.$size, '%s has a size of '.$size]
    ));
  }

  public function contains($element) {
    $rep= self::stringOf($element);
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
    $rep= self::stringOf($element);
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

  public function startsWith($element) {
    $rep= self::stringOf($element);
    return $this->is(new Match(
      function($value) use($element) {
        return sizeof($value) > 0 && Objects::equal($value[0], $element);
      },
      ['%s does not start with '.$rep, '%s starts with '.$rep]
    ));
  }

  public function endsWith($element) {
    $rep= self::stringOf($element);
    return $this->is(new Match(
      function($value) use($element) {
        return sizeof($value) > 0 && Objects::equal($value[sizeof($value) - 1], $element);
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