<?php namespace unittest\assert\unittest;

use lang\IndexOutOfBoundsException;
use unittest\TestCase;
use unittest\assert\InstanceExtractor;

/**
 * Tests the `InstanceExtractor` class.
 */
class InstanceExtractorTest extends TestCase {

  /** @return unittest.assert.unittest.Name */
  protected function fixture($def) {
    return newinstance(Name::class, ['Test'], $def);
  }

  #[@test]
  public function existant_property() {
    $extractor= (new InstanceExtractor($this->fixture(['id' => 1])));
    $this->assertEquals(1, $extractor->extract('id'));
  }

  #[@test]
  public function existant_property_accessor() {
    $extractor= (new InstanceExtractor($this->fixture(['id' => function() { return 1; }])));
    $this->assertEquals(1, $extractor->extract('id'));
  }

  #[@test]
  public function existant_getter() {
    $extractor= (new InstanceExtractor($this->fixture(['getId' => function() { return 1; }])));
    $this->assertEquals(1, $extractor->extract('id'));
  }

  #[@test, @expect([
  #  'class'       => IndexOutOfBoundsException::class,
  #  'withMessage' => '/Cannot extract "non-existant" from unittest.assert.unittest.Name/',
  #])]
  public function non_existant() {
    (new InstanceExtractor($this->fixture([])))->extract('non-existant');
  }
}