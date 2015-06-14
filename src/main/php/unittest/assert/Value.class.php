<?php namespace unittest\assert;

use lang\Type;
use unittest\AssertionFailedError;

class Value extends \lang\Object {
  protected $value;

  /**
   * Creates a new instance
   *
   * @param  var $value
   */
  public function __construct($value) {
    $this->value= $value;
  }

  /**
   * Creates a value instance from any given value; specializing if necessary.
   *
   * @param  var $value
   * @return self
   */
  public static function of($value) {
    if (is_array($value) && 0 === key($value)) {
      return new ArrayValue($value);
    } else if (is_array($value)) {
      return new MapValue($value);
    } else if (is_string($value)) {
      return new StringValue($value);
    } else if (is_int($value) || is_double($value)) {
      return new NumericValue($value);
    } else {
      return new self($value);
    }
  }

  /**
   * Assert a given condition matches this value
   * 
   * @param  unittest.assert.Condition $condition
   * @return self
   */
  public function is(Condition $condition) {
    Assertions::verify(function() use($condition) {
      if ($condition->matches($this->value)) {
        return null;
      } else {
        return new AssertionFailedError('Failed to verify that '.$condition->describe($this->value, true));
      }
    });
    return $this;
  }

  /**
   * Assert a given condition does not match this value
   * 
   * @param  unittest.assert.Condition $condition
   * @return self
   */
  public function isNot(Condition $condition) {
    Assertions::verify(function() use($condition) {
      if ($condition->matches($this->value)) {
        return new AssertionFailedError('Failed to verify that '.$condition->describe($this->value, false));
      } else {
        return null;
      }
    });
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
   * Assert this value is empty
   *
   * @return self
   */
  public function isEmpty() {
    return $this->is(new NotPossible('is empty'));
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
    return $this->is(new NotPossible('starts with anything'));
  }

  /**
   * Assert this value ends with a given element
   * 
   * @param  var $element
   * @return self
   */
  public function endsWith($element) {
    return $this->is(new NotPossible('ends with anything'));
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

  /**
   * Assert this value is greater than a given comparison
   *
   * @param  int|double $comparison
   * @return self
   */
  public function isGreaterThan($comparison) {
    return $this->is(new NotPossible('cannot be greater than anything'));
  }

  /**
   * Assert this value is less than a given comparison
   *
   * @param  int|double $comparison
   * @return self
   */
  public function isLessThan($comparison) {
    return $this->is(new NotPossible('cannot be less than anything'));
  }

  /**
   * Assert this value is between start and end (both included)
   *
   * @param  int|double $start
   * @param  int|double $end
   * @return self
   */
  public function isBetween($start, $end) {
    return $this->is(new NotPossible('cannot be between anything'));
  }

  /**
   * Assert this value is close to a given comparison inside a given tolerance.
   * If the difference is exactly the tolerance, this assertion is considered valid.
   *
   * @param  int|double $comparison
   * @param  int|double $tolerance
   * @return self
   */
  public function isCloseTo($comparison, $tolerance) {
    return $this->is(new NotPossible('cannot be close to anything'));
  }

  /**
   * Assert a given value is an instance of a given type
   *
   * @param  string|lang.Type $type
   * @return self
   */
  public function isInstanceOf($type) {
    return $this->is(new Instance($type instanceof Type ? $type : Type::forName($type)));
  }

  /**
   * Extract a given arg
   *
   * @param  string|string[]|function(var): var $arg
   * @return self
   */
  public function extracting($arg) {
    if ($arg instanceof \Closure) {
      return self::of($arg($this->value));
    } else if (is_array($arg)) {
      $value= [];
      foreach ($arg as $key => $extract) {
        $value[$key]= $this->extracting($extract)->value;
      }
      return self::of($value);
    } else {
      return self::of((new InstanceExtractor($this->value))->extract($arg));
    }
  }
}