<?php namespace unittest\assert;

use lang\Generic;
use lang\IndexOutOfBoundsException;

/**
 * Extracts properties from a given instance
 *
 * @test  xp://unittest.assert.unittest.InstanceExtractorTest
 */
class InstanceExtractor extends \lang\Object {
  protected $value;

  /**
   * Creates a new instance with a given value
   *
   * @param  lang.Generic $value
   */
  public function __construct(Generic $value) {
    $this->value= $value;
  }

  /**
   * Extracts a given key
   *
   * @param  string $key
   * @param  var
   * @throws lang.IndexOutOfBoundsException
   */
  public function extract($key) {
    foreach ([$key, 'get'.$key] as $variant) {
      if (method_exists($this->value, $variant)) return $this->value->{$variant}();
    }
    if (property_exists($this->value, $key)) {
      return $this->value->{$key};
    }
    throw new IndexOutOfBoundsException('Cannot extract "'.$key.'" from '.Value::stringOf($this->value));
  }
}