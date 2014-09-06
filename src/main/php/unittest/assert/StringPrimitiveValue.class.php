<?php namespace unittest\assert;

class StringPrimitiveValue extends Value {

  public function startsWith($string) {
    $this->verify[]= function() use($string) {
      return (
        '' !== $this->value &&
        0 === substr_compare($this->value, $string, 0, strlen($string))
      );
    };
    return $this;
  }

  public function endsWith($string) {
    $this->verify[]= function() use($string) {
      return (
        '' !== $this->value &&
        0 === substr_compare($this->value, $string, -strlen($string))
      );
    };
    return $this;
  }

  public function contains($string) {
    $this->verify[]= function() use($string) {
      return false !== strpos($this->value, $string);
    };
    return $this;
  }

  public function doesNotContain($string) {
    $this->verify[]= function() use($string) {
      return false === strpos($this->value, $string);
    };
    return $this;
  }
}