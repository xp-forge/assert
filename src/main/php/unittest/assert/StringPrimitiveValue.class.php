<?php namespace unittest\assert;

class StringPrimitiveValue extends Value {

  public function hasSize($size) {
    return $this->is(new Match(function($value) use($size) {
      return strlen($value) === $size;
    }));
  }

  public function startsWith($string) {
    return $this->is(new Match(function($value) use($string) {
      return (
        '' !== $value &&
        0 === substr_compare($value, $string, 0, strlen($string))
      );
    }));
  }

  public function endsWith($string) {
    return $this->is(new Match(function($value) use($string) {
      return (
        '' !== $value &&
        0 === substr_compare($value, $string, -strlen($string))
      );
    }));
  }

  public function contains($string) {
    return $this->is(new Match(function($value) use($string) {
      return false !== strpos($value, $string);
    }));
  }

  public function doesNotContain($string) {
    return $this->is(new Match(function($value) use($string) {
      return false === strpos($value, $string);
    }));
  }
}