<?php namespace unittest\assert\unittest;

use lang\XPClass;
use unittest\assert\Match;

class TestCaseAssertions extends \unittest\assert\Value {

  /** @return lang.Type */
  protected static function type() { return XPClass::forName('unittest.TestCase'); }

  public function hasName($name) {
    return $this->extracting('name')->isEqualTo($name);
  }

  public function isIgnored() {
    return $this->is(new Match(
      function($value) { return $value->getClass()->getMethod($value->name)->hasAnnotation('ignore'); },
      ['%s is not ignored', '%s is ignored']
    ));
  }
}