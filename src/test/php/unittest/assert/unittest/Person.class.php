<?php namespace unittest\assert\unittest;

use util\Objects;

class Person implements \lang\Value {
  private $id;
  private $name;
  private $age;
  private $department;

  /**
   * Creates a new person
   *
   * @param  int $id
   * @param  string $name
   * @param  int $arg
   * @param  var $department
   */
  public function __construct($id, $name, $age, $department) {
    $this->id= $id;
    $this->name= $name;
    $this->age= $age;
    $this->department= $department;
  }

  /** @return int */
  public function id() { return $this->id; }

  /** @return string */
  public function name() { return $this->name; }

  /** @return int */
  public function age() { return $this->age; }

  /** @return var */
  public function department() { return $this->department; }

  /** @return string */
  public function toString() { return nameof($this).'@'.Objects::stringOf(get_object_vars($this)); }

  /** @return string */
  public function hashCode() { return 'P'.Objects::hashOf((array)$this); }

  /**
   * Compares
   *
   * @param  var $value
   * @return int
   */
  public function compareTo($value) {
    return $value instanceof self ? Objects::compare((array)$this, (array)$value) : 1;
  }
}