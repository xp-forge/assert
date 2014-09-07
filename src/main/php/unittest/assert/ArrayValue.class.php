<?php namespace unittest\assert;

class ArrayValue extends Value {

  public function hasSize($size) {
    return $this->is(new Match(function($value) use($size) {
      return $value->length === $size;
    }));
  }

  public function contains($element) {
    return $this->is(new Predicate('contains', $element));
  }

  public function doesNotContain($element) {
    return $this->isNot(new Predicate('contains', $element));
  }
}