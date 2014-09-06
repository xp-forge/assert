<?php namespace unittest\assert\unittest;

abstract class AbstractAssertionsTest extends \unittest\TestCase {

  /** @return var[] */
  protected function fixtures($filter= null) {
    $fixtures= [
      0, -1, 1,
      1.0, 0.5,
      true, false,
      '', 'Fixture',
      null, $this,
      [[]]
    ];
    if ($filter) {
      return array_filter($fixtures, function($value) use($filter) { return $value !== $filter[0]; });
    } else {
      return $fixtures;
    }
  }
}