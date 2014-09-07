<?php namespace unittest\assert;

class StringPrimitiveValue extends Value {

  public function hasSize($size) {
    return $this->is(new Match(function($value) use($size) {
      return strlen($value) === $size;
    }));
  }

  public function startsWith($string) {
    $rep= Condition::stringOf($string);
    return $this->is(new Match(
      function($value) use($string) {
        return ('' !== $value && 0 === substr_compare($value, $string, 0, strlen($string)));
      },
      ['%s does not start with '.$rep, '%s starts with '.$rep]
    ));
  }

  public function endsWith($string) {
    $rep= Condition::stringOf($string);
    return $this->is(new Match(
      function($value) use($string) {
        return ('' !== $value && 0 === substr_compare($value, $string, -strlen($string)));
      },
      ['%s does not end with '.$rep, '%s ends with '.$rep]
    ));
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