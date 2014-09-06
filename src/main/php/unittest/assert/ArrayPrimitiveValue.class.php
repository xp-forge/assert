<?php namespace unittest\assert;

class ArrayPrimitiveValue extends Value {

  public function hasSize($size) {
    $this->verify[]= function() use($size) {
      return sizeof($this->value) === $size;
    };
    return $this;
  }

  public function contains($element) {
    $this->verify[]= function() use($element) {
      foreach ($this->value as $value) {
        if ($value === $element) return true;
      }
      return false;
    };
    return $this;
  }

  public function doesNotContain($element) {
    $this->verify[]= function() use($element) {
      foreach ($this->value as $value) {
        if ($value === $element) return false;
      }
      return true;
    };
    return $this;
  }
}