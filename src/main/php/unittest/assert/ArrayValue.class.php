<?php namespace unittest\assert;

class ArrayValue extends Value {

  public function hasSize($size) {
    $this->verify[]= function() use($size) {
      return $this->value->length === $size;
    };
    return $this;
  }

  public function contains($element) {
    $this->verify[]= function() use($element) {
      return $this->value->contains($element);
    };
    return $this;
  }

  public function doesNotContain($element) {
    $this->verify[]= function() use($element) {
      return !$this->value->contains($element);
    };
    return $this;
  }
}