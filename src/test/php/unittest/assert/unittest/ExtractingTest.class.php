<?php namespace unittest\assert\unittest;

use unittest\assert\Value;
use lang\types\ArrayMap;

/**
 * Tests `extracting()` method.
 */
class ExtractingTest extends AbstractAssertionsTest {

  protected function people() {
    return [
      [['id' => 1, 'name' => 'Test', 'age' => 42]],
      [new ArrayMap(['id' => 1, 'name' => 'Test', 'age' => 42])],
      [newinstance('lang.Object', [], [
        'id'   => 1,
        'name' => 'Test',
        'age'  => 42
      ])],
      [newinstance('lang.Object', [], [
        'id'   => function() { return 1; },
        'name' => function() { return 'Test'; },
        'age'  => function() { return 42; }
      ])],
      [newinstance('lang.Object', [], [
        'getId'   => function() { return 1; },
        'getName' => function() { return 'Test'; },
        'getAge'  => function() { return 42; }
      ])]
    ];
  }

  #[@test, @values('people')]
  public function extracting($person) {
    $this->assertVerified(Value::of($person)->extracting('name')->isEqualTo('Test'));
  }

  #[@test, @values('people')]
  public function extracting_multiple($person) {
    $this->assertVerified(Value::of($person)->extracting(['name', 'age'])->isEqualTo(['Test', 42]));
  }
}