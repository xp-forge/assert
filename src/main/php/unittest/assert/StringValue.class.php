<?php namespace unittest\assert;

class StringValue extends Value {

  public function hasSize($size) {
    return $this->is(new Match(
      function($value) use($size) { return $value->length() === $size; },
      ['%s does not have a length of '.$size, '%s has a length of '.$size]
    ));
  }

  public function startsWith($string) {
    return $this->is(new Predicate('startsWith', $string, [
      '%s does not start with %s',
      '%s starts with %s',
    ]));
  }

  public function endsWith($string) {
    return $this->is(new Predicate('endsWith', $string, [
      '%s does not end with %s',
      '%s ends with %s',
    ]));
  }

  public function contains($string) {
    return $this->is(new Predicate('contains', $string, [
      '%s does not contain %s',
      '%s contains %s',
    ]));
  }

  public function doesNotContain($string) {
    return $this->isNot(new Predicate('contains', $string, [
      '%s does not contain %s',
      '%s contains %s',
    ]));
  }
}