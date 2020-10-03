<?php namespace unittest\assert\unittest;

use unittest\assert\{Assertions, AssertionsFailed};
use unittest\{AssertionFailedError, FormattedMessage};
use util\Objects;

abstract class AbstractAssertionsTest extends \unittest\TestCase {

  public function setUp() {
    $this->failed= Assertions::enter(new AssertionsFailed());
  }

  public function tearDown() {
    Assertions::leave();
  }

  /**
   * Assertion helpeer
   *
   * @param  string[] $patterns
   * @param  unittest.assert.Value $assert
   * @throws unittest.AssertionFailedError
   */
  protected function assertUnverified($patterns, $assert) {
    $messages= new AssertionsFailed();
    $failures= $this->failed->failures();
    if (sizeof($failures) !== sizeof($patterns)) {
      $messages->add(new AssertionFailedError(new FormattedMessage(
        'Expected %d failures but have %d: %s',
        [sizeof($patterns), sizeof($failures), Objects::stringOf($failures)]
      )));
    }
    foreach ($failures as $i => $failure) {
      $message= $failure->getMessage();
      if (!preg_match($patterns[$i], $message)) {
        $messages->add(new AssertionFailedError(new FormattedMessage(
          'Expected `%s` to match %s',
          [$message, $patterns[$i]]
        )));
      }
    }
    $messages->raiseIf();
  }

  /**
   * Assertion helpeer
   *
   * @param  unittest.assert.Value $assert
   * @throws unittest.AssertionFailedError
   */
  protected function assertVerified($assert) {
    $this->assertTrue($this->failed->isEmpty());
  }

  /** @return var[][] */
  protected function fixtures($filter= null) {
    $fixtures= [
      [0], [-1], [1],
      [1.0], [0.5],
      [true], [false],
      [''], ['Test'],
      [null], [$this],
      [[]]
    ];
    if ($filter) {
      return array_filter($fixtures, function($value) use($filter) { return $value !== $filter; });
    } else {
      return $fixtures;
    }
  }
}