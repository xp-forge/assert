<?php namespace unittest\assert;

use lang\Type;

/**
 * Maps types
 *
 * @test  xp://unittest.assert.unittest.TypeMapTest
 */
class TypeMap extends \lang\Object implements \ArrayAccess {
  protected $types= [];

  /**
   * Finds a given type and returns the key, or NULL if nothing is found
   *
   * @param  lang.Type $type
   * @param  string
   */
  protected function find(Type $type) {
    $class= $type->getName();
    if (isset($this->types[$class])) {
      return $class;
    } else {
      foreach ($this->types as $mapped => $to) {
        if (Type::forName($mapped)->isAssignableFrom($type)) return $mapped;
      }
    }
    return null;
  }

  /**
   * Maps a given type to a given value
   *
   * @param   lang.Type $type
   * @param   var $value
   * @return  self
   */
  public function map(Type $type, $value) {
    $this->types[$type->getName()]= $value;
    return $this;
  }

  /**
   * Gets mapping for a given type
   *
   * @param   lang.Type $type
   * @param   var $default
   * @return  var $value
   */
  public function get($type, $default= null) {
    if ($found= $this->find($type)) {
      return $this->types[$found];
    } else {
      return $default;
    }
  }

  /**
   * list[]= overloading
   *
   * @param   lang.Type $type
   * @param   var $value
   * @throws  lang.IllegalArgumentException if key is neither a string (set) nor NULL (add)
   */
  public function offsetSet($type, $value) {
    $this->types[$type->getName()]= $value;
  }

  /**
   * = list[] overloading
   *
   * @param   lang.Type $type
   * @return  var
   * @throws  lang.IndexOutOfBoundsException if key does not exist
   */
  public function offsetGet($type) {
    if ($found= $this->find($type)) {
      return $this->types[$found];
    } else {
      raise('lang.IndexOutOfBoundsException', 'No element for type '.$type);
    }
  }

  /**
   * isset() overloading
   *
   * @param   lang.Type $type
   * @return  bool
   */
  public function offsetExists($type) {
    return null !== $this->find($type);
  }

  /**
   * unset() overloading
   *
   * @param   lang.Type $type
   */
  public function offsetUnset($type) {
    unset($this->types[$type->getName()]);
  }
}