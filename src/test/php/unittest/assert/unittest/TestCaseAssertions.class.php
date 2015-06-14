<?php namespace unittest\assert\unittest;

use lang\XPClass;

class TestCaseAssertions extends \unittest\assert\Value {

  /** @return lang.Type */
  protected static function type() { return XPClass::forName('unittest.TestCase'); }

  public function hasName($name) {
    return $this->extracting('name')->isEqualTo($name);
  }
}