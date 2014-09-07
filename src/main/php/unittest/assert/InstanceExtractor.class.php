<?php namespace unittest\assert;

class InstanceExtractor extends \lang\Object {
  protected $value;

  public function __construct($value) {
    $this->value= $value;
  }

  public function extract($key) {
    if (property_exists($this->value, $key)) {
      return $this->value->{$key};
    } else {
      foreach ([$key, 'get'.$key] as $variant) {
        if (method_exists($this->value, $variant)) return $this->value->{$variant}();
      }
    }
    throw new \lang\IndexOutOfBoundsException('Cannot extract "'.$key.'" from '.Value::stringOf($this->value));
  }
}