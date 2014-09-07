<?php namespace unittest\assert;

class MapValue extends Value {

  public function hasSize($size) {
    return $this->is(new Match(
      function($value) use($size) { return $value->size === $size; },
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
}