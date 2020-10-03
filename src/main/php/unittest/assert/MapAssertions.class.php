<?php namespace unittest\assert;

use util\Objects;

class MapAssertions extends Assertions {

  public function hasSize($size) {
    return $this->is(new MatchUsing(
      function($value) use($size) { return sizeof($value) === $size; },
      ['%s does not have a size of '.$size, '%s has a size of '.$size]
    ));
  }

  public function isEmpty() {
    return $this->is(new MatchUsing(
      function($value) { return empty($value); },
      ['%s is not empty', '%s is empty']
    ));
  }

  public function contains($element) {
    $rep= Condition::stringOf($element);
    return $this->is(new MatchUsing(
      function($value) use($element) {
        foreach ($value as $value) {
          if ($value === $element) return true;
        }
        return false;
      },
      ['%s does not contain '.$rep, '%s contains '.$rep]
    ));
  }

  public function doesNotContain($element) {
    $rep= Condition::stringOf($element);
    return $this->isNot(new MatchUsing(
      function($value) use($element) {
        foreach ($value as $value) {
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
   * @param  string|string[]|function(var): var $arg
   * @return self
   */
  public function extracting($arg) {
    if ($arg instanceof \Closure) {
      return self::of($arg($this->value));
    } else if (is_array($arg)) {
      $value= [];
      foreach ($arg as $key => $extract) {
        $value[$key]= $this->extracting($extract)->value;
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