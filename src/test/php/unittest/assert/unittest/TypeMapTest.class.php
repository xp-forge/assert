<?php namespace unittest\assert\unittest;

use unittest\assert\TypeMap;
use lang\XPClass;
use lang\Type;

/**
 * Tests the `TypeMap` class.
 */
class TypeMapTest extends \unittest\TestCase {
  const FOUND = 'found';

  #[@test]
  public function can_create() {
    new TypeMap();
  }

  #[@test]
  public function test_non_existant_returns_false() {
    $map= new TypeMap();
    $this->assertFalse(isset($map[XPClass::forName('lang.Object')]));
  }

  #[@test]
  public function test_direct_type_returns_true() {
    $map= (new TypeMap())->map(XPClass::forName('lang.Object'), self::FOUND);
    $this->assertTrue(isset($map[XPClass::forName('lang.Object')]));
  }

  #[@test]
  public function test_parent_type_returns_true() {
    $map= (new TypeMap())->map(XPClass::forName('lang.Object'), self::FOUND);
    $this->assertTrue(isset($map[XPClass::forName('unittest.TestCase')]));
  }

  #[@test]
  public function test_interface_type_returns_true() {
    $map= (new TypeMap())->map(XPClass::forName('lang.Generic'), self::FOUND);
    $this->assertTrue(isset($map[XPClass::forName('unittest.TestCase')]));
  }

  #[@test]
  public function lookup_non_existant_returns_null() {
    $this->assertEquals(null, (new TypeMap())->get(XPClass::forName('lang.Object')));
  }

  #[@test, @expect('lang.IndexOutOfBoundsException')]
  public function read_non_existant_throws_exception() {
    $this->assertEquals(null, (new TypeMap())[XPClass::forName('lang.Object')]);
  }

  #[@test]
  public function lookup_direct_type() {
    $map= (new TypeMap())->map(XPClass::forName('lang.Object'), self::FOUND);
    $this->assertEquals(self::FOUND, $map->get(XPClass::forName('lang.Object')));
  }

  #[@test]
  public function read_direct_type() {
    $map= (new TypeMap())->map(XPClass::forName('lang.Object'), self::FOUND);
    $this->assertEquals(self::FOUND, $map[XPClass::forName('lang.Object')]);
  }

  #[@test]
  public function lookup_parent_type() {
    $map= (new TypeMap())->map(XPClass::forName('lang.Object'), self::FOUND);
    $this->assertEquals(self::FOUND, $map->get(XPClass::forName('unittest.TestCase')));
  }

  #[@test]
  public function read_parent_type() {
    $map= (new TypeMap())->map(XPClass::forName('lang.Object'), self::FOUND);
    $this->assertEquals(self::FOUND, $map[XPClass::forName('unittest.TestCase')]);
  }

  #[@test]
  public function lookup_interface_type() {
    $map= (new TypeMap())->map(XPClass::forName('lang.Generic'), self::FOUND);
    $this->assertEquals(self::FOUND, $map->get(XPClass::forName('unittest.TestCase')));
  }

  #[@test]
  public function read_interface_type() {
    $map= (new TypeMap())->map(XPClass::forName('lang.Generic'), self::FOUND);
    $this->assertEquals(self::FOUND, $map[XPClass::forName('unittest.TestCase')]);
  }

  #[@test]
  public function test_var_type() {
    $map= (new TypeMap())->map(Type::$VAR, self::FOUND);
    $this->assertTrue(isset($map[XPClass::forName('lang.Object')]));
  }

  #[@test]
  public function lookup_var_type() {
    $map= (new TypeMap())->map(Type::$VAR, self::FOUND);
    $this->assertEquals(self::FOUND, $map->get(XPClass::forName('lang.Object')));
  }

  #[@test]
  public function read_var_type() {
    $map= (new TypeMap())->map(Type::$VAR, self::FOUND);
    $this->assertEquals(self::FOUND, $map[XPClass::forName('lang.Object')]);
  }
}