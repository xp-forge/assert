<?php namespace unittest\assert;

use util\Objects;
use unittest\AssertionFailedError;
use lang\types\ArrayList;
use lang\types\String;

class Value extends \lang\Object {
  protected $value;
  protected $verify= [];

  /**
   * Creates a new instance
   *
   * @param  var $value
   */
  protected function __construct($value) {
    $this->value= $value;
  }

  /**
   * Creates a value instance from any given value; specializing if necessary.
   *
   * @param  var $value
   * @return unittest.assert.Value
   */
  public static function of($value) {
    if (is_array($value)) {
      return new ArrayPrimitiveValue($value);
    } else if (is_string($value)) {
      return new StringPrimitiveValue($value);
    } else if ($value instanceof ArrayList) {
      return new ArrayValue($value);
    } else if ($value instanceof String) {
      return new StringValue($value);
    } else {
      return new Value($value);
    }
  }

  /**
   * Creates a string representation of any given value.
   *
   * @param  var $value
   * @return string
   */
  public static function stringOf($value) {
    return null === $value ? 'null' : Objects::stringOf($value);
  }

  /**
   * Verify this assertion
   *
   * @param  unittest.assert.AssertionsFailed $failed
   * @return unittest.assert.AssertionsFailed $failed
   */
  public function verify(AssertionsFailed $failed) {
    foreach ($this->verify as $verify) {
      $verify($failed);
    }
    return $failed;
  }

  /**
   * Assert a given condition matches this value
   * 
   * @param  unittest.assert.Condition $condition
   * @return self
   */
  public function is(Condition $condition) {
    $this->verify[]= function($failed) use($condition) {
      if (!$condition->matches($this->value)) {
        $failed->add(new AssertionFailedError('Failed to verify that '.$condition->describe($this->value, true)));
      }
    };
    return $this;
  }

  /**
   * Assert a given condition does not match this value
   * 
   * @param  unittest.assert.Condition $condition
   * @return self
   */
  public function isNot(Condition $condition) {
    $this->verify[]= function($failed) use($condition) {
      if ($condition->matches($this->value)) {
        $failed->add(new AssertionFailedError('Failed to verify that '.$condition->describe($this->value, false)));
      }
    };
    return $this;
  }

  /**
   * Assert a given value is equal to this value
   * 
   * @param  var $compare
   * @return self
   */
  public function isEqualTo($compare) {
    return $this->is(new Equals($compare));
  }

  /**
   * Assert a given value is not equal to this value
   * 
   * @param  var $compare
   * @return self
   */
  public function isNotEqualTo($compare) {
    return $this->isNot(new Equals($compare));
  }

  /**
   * Assert a this value is null
   * 
   * @return self
   */
  public function isNull() {
    return $this->is(new Identical(null));
  }

  /**
   * Assert a this value is true
   * 
   * @return self
   */
  public function isTrue() {
    return $this->is(new Identical(true));
  }

  /**
   * Assert a this value is false
   * 
   * @return self
   */
  public function isFalse() {
    return $this->is(new Identical(false));
  }

  /**
   * Assert this value is contained in a given enumerable
   * 
   * @param  var $enumerable
   * @return self
   */
  public function isIn($enumerable) {
    return $this->is(new ContainedIn($enumerable));
  }

  /**
   * Assert this value is not contained in a given enumerable
   * 
   * @param  var $enumerable
   * @return self
   */
  public function isNotIn($enumerable) {
    return $this->isNot(new ContainedIn($enumerable));
  }

  /**
   * Assert this value has a given size
   * 
   * @param  int $size
   * @return self
   */
  public function hasSize($size) {
    return $this->is(new NotPossible('has a size'));
  }

  /**
   * Assert this value starts with a given element
   * 
   * @param  var $element
   * @return self
   */
  public function startsWith($element) {
    return $this->is(new NotPossible('starts with anythingh'));
  }

  /**
   * Assert this value ends with a given element
   * 
   * @param  var $element
   * @return self
   */
  public function endsWith($element) {
    return $this->is(new NotPossible('ends with anythingh'));
  }

  /**
   * Assert this value contains a given element
   * 
   * @param  var $element
   * @return self
   */
  public function contains($element) {
    return $this->is(new NotPossible('contains anything'));
  }

  /**
   * Assert this value does not contain given element
   * 
   * @param  var $element
   * @return self
   */
  public function doesNotContain($element) {
    return $this->is(new NotPossible('does not contain anything'));
  }
}