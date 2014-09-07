<?php namespace unittest\assert\unittest;

use unittest\assert\InstanceExtractor;

/**
 * Tests the `InstanceExtractor` class.
 */
class InstanceExtractorTest extends \unittest\TestCase {

  /** @return lang.Object */
  protected function fixture($def) {
    return newinstance('lang.Object', [], $def);
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

  #[@test, @expect(
  #  class= 'lang.IndexOutOfBoundsException',
  #  withMessage= '/Cannot extract "non-existant" from lang.Object/'
  #)]
  public function non_existant() {
    (new InstanceExtractor($this->fixture([])))->extract('non-existant');
  }
}