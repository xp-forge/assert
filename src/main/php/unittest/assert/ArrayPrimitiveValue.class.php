<?php namespace unittest\assert;

class ArrayPrimitiveValue extends Value {

  public function hasSize($size) {
    return $this->is(new Match(function($value) use($size) {
      return sizeof($this->value) === $size;
    }));
  }

  public function contains($element) {
    return $this->is(new Match(function($value) use($element) {
      foreach ($this->value as $value) {
        if ($value === $element) return true;
      }
      return false;
    }));
  }

  public function doesNotContain($element) {
    return $this->isNot(new Match(function($value) use($element) {
      foreach ($this->value as $value) {
        if ($value === $element) return true;
      }
      return false;
    }));
  }
}