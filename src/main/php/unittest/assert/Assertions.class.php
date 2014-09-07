<?php namespace unittest\assert;

use lang\IllegalStateException;
use util\collections\Vector;
use unittest\TestCase;
use unittest\TestAction;
use unittest\AssertionFailedError;

/**
 * Use this assertions action to decorate any class you wish to use the
 * `Assert::that()` method in.
 */
class Assertions extends \lang\Object implements TestAction {
  const DECLARATION = '#[@action(new \unittest\assert\Assertions())]';
  const CURRENT = 0;
  protected static $verify= [];

  /**
   * Creates a new verification
   *
   * @param  unittest.assert.Value $value
   * @return unittest.assert.Value
   * @throws lang.IllegalStateException
   */
  public static function verifyThat($value) {
    if (self::$verify) {
      self::$verify[self::CURRENT]->add($value);
      return $value;
    } else {
      throw new IllegalStateException('You need to decorate your unittest class with '.self::DECLARATION);
    }
  }

  /**
   * Runs before a given test
   *
   * @param  unittest.TestCase $t
   * @throws unittest.AssertionFailedError
   */
  public function beforeTest(TestCase $t) {
    array_unshift(self::$verify, new Vector());
  }

  /**
   * Runs after a given test
   *
   * @param  unittest.TestCase $t
   * @throws unittest.AssertionFailedError
   */
  public function afterTest(TestCase $t) {
    $failed= new AssertionsFailed();
    foreach (array_shift(self::$verify) as $value) {
      $value->verify($failed);
    }
    $failed->raiseIf();
  }
}