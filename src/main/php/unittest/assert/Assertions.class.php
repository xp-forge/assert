<?php namespace unittest\assert;

use lang\IllegalStateException;
use util\collections\Vector;
use unittest\TestCase;
use unittest\AssertionFailedError;

/**
 * Use this assertions action to decorate any class you wish to use the
 * `Assert::that()` method in.
 */
class Assertions extends \lang\Object {
  const CURRENT = 0;
  protected static $verify= [];

  /**
   * Enters context
   *
   * @param  var $context
   * @return var The given context
   */
  public static function enter($context) {
    array_unshift(self::$verify, $context);
    return $context;
  }

  public static function verify($condition) {
    $error= $condition();
    if (null === $error) {
      return;
    } else if (self::$verify) {
      self::$verify[self::CURRENT]->add($error);
    } else {
      throw $error;
    }
  }

  /**
   * Leaves context
   *
   * @return var
   */
  public static function leave() {
    return array_shift(self::$verify);
  }
}