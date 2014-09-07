<?php namespace unittest\assert;

use util\Objects;

class ArrayPrimitiveValue extends Value {

  public function hasSize($size) {
    return $this->is(new Match(function($value) use($size) {
      return sizeof($this->value) === $size;
    }));
  }

  public function contains($element) {
    $rep= Objects::stringOf($element);
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
    $rep= Objects::stringOf($element);
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