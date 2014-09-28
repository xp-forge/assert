<?php namespace unittest\assert;

use lang\Type;
use lang\XPClass;
use lang\ArrayType;
use lang\MapType;
use lang\Primitive;
use util\Objects;
use unittest\AssertionFailedError;

class Value extends \lang\Object {
  protected static $types;
  protected $value;
  protected $verify= [];

  static function __static() {
    $ctor= Type::forName('function(var): unittest.assert.Value');
    self::$types= (new TypeMap())
      ->map(Primitive::$STRING, $ctor->cast('unittest\assert\StringPrimitiveValue::new'))
      ->map(ArrayType::forName('var[]'), $ctor->cast('unittest\assert\ArrayPrimitiveValue::new'))
      ->map(MapType::forName('[:var]'), $ctor->cast('unittest\assert\MapPrimitiveValue::new'))
      ->map(XPClass::forName('lang.types.String'), $ctor->cast('unittest\assert\StringValue::new'))
      ->map(XPClass::forName('lang.types.ArrayList'), $ctor->cast('unittest\assert\ArrayValue::new'))
      ->map(XPClass::forName('lang.types.ArrayMap'), $ctor->cast('unittest\assert\MapValue::new'))
      ->map(Type::$VAR, $ctor->cast('unittest\assert\Value::new'))
    ;
  }

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
   * @return unittest.assert.Value
   */
  public static function of($value) {
    $ctor= self::$types[typeof($value)];
    return $ctor($value);
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
   * Assert a given value is an instance of a given type
   *
   * @param  var $type
   * @return self
   */
  public function isInstanceOf($type) {
    return $this->is(new Instance($type instanceof Type ? $type : Type::forName($type)));
  }

  /**
   * Extract a given arg
   *
   * @param  var $arg
   * @return self
   */
  public function extracting($arg) {
    $extractor= new InstanceExtractor($this->value);
    if (is_array($arg)) {
      $value= [];
      foreach ($arg as $key) {
        $value[]= $extractor->extract($key);
      }
      return self::of($value);
    } else {
      return self::of($extractor->extract($arg));
    }
  }
}