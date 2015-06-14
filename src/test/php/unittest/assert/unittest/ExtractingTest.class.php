<?php namespace unittest\assert\unittest;

use unittest\assert\Value;

/**
 * Tests `extracting()` method.
 */
class ExtractingTest extends AbstractAssertionsTest {

  /** @return var[][] */
  protected function people() {
    return [
      [['id' => 1, 'name' => 'Test', 'age' => 42, 'department' => ['name' => 'Test']]],
      [newinstance('lang.Object', [], [
        'id'            => 1,
        'name'          => 'Test',
        'age'           => 42,
        'department'    => ['name' => 'Test']
      ])],
      [newinstance('lang.Object', [], [
        'id'            => function() { return 1; },
        'name'          => function() { return 'Test'; },
        'age'           => function() { return 42; },
        'department'    => function() { return ['name' => 'Test']; }
      ])],
      [newinstance('lang.Object', [], [
        'getId'         => function() { return 1; },
        'getName'       => function() { return 'Test'; },
        'getAge'        => function() { return 42; },
        'getDepartment' => function() { return ['name' => 'Test']; }
      ])],
      [new Person(1, 'Test', 42, ['name' => 'Test'])]
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

  #[@test, @values('people')]
  public function extracting_chained($person) {
    $this->assertVerified(Value::of($person)->extracting('department')->extracting('name')->isEqualTo('Test'));
  }

  #[@test, @values('people')]
  public function extracting_from_array($person) {
    $this->assertVerified(Value::of([$person, $person])->extracting('name')->isEqualTo(['Test', 'Test']));
  }

  #[@test]
  public function extracting_from_instance_via_closure() {
    $this->assertVerified(Value::of(new Person(1, 'Test', 42, ['name' => 'Test']))
      ->extracting(function($person) { return $person->name(); })
      ->isEqualTo('Test')
    );
  }

  #[@test]
  public function extracting_from_map_via_closure() {
    $this->assertVerified(Value::of(['id' => 1, 'name' => 'Test'])
      ->extracting(function($person) { return $person['name']; })
      ->isEqualTo('Test')
    );
  }
}