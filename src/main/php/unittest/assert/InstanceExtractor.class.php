<?php namespace unittest\assert;

use lang\IndexOutOfBoundsException;

/**
 * Extracts properties from a given instance
 *
 * @test  xp://unittest.assert.unittest.InstanceExtractorTest
 */
class InstanceExtractor {
  protected $value;

  /**
   * Creates a new instance with a given value
   *
   * @param  object $value
   */
  public function __construct($value) {
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
    throw new IndexOutOfBoundsException('Cannot extract "'.$key.'" from '.Condition::stringOf($this->value));
  }
}