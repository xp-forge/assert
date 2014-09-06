<?php namespace unittest\assert;

class StringValue extends Value {

  public function startsWith($string) {
    $this->verify[]= function() use($string) {
      return $this->value->startsWith($string);
    };
    return $this;
  }

  public function endsWith($string) {
    $this->verify[]= function() use($string) {
      return @$this->value->endsWith($string);
    };
    return $this;
  }

  public function contains($string) {
    $this->verify[]= function() use($string) {
      return $this->value->contains($string);
    };
    return $this;
  }

  public function doesNotContain($string) {
    $this->verify[]= function() use($string) {
      return !$this->value->contains($string);
    };
    return $this;
  }
}