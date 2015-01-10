<?php namespace unittest\assert\unittest;

class Person extends \lang\Object {
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

}