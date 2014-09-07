<?php namespace unittest\assert;

use util\Objects;

class ArrayPrimitiveValue extends Value {

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
}