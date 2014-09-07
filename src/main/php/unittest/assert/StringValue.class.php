<?php namespace unittest\assert;

class StringValue extends Value {

  public function hasSize($size) {
    return $this->is(new Match(function($value) use($size) {
      return $value->length() === $size;
    }));
  }

  public function startsWith($string) {
    return $this->is(new Predicate('startsWith', $string));
  }

  public function endsWith($string) {
    return $this->is(new Predicate('endsWith', $string));
  }

  public function contains($string) {
    return $this->is(new Predicate('contains', $string));
  }

  public function doesNotContain($string) {
    return $this->isNot(new Predicate('contains', $string));
  }
}