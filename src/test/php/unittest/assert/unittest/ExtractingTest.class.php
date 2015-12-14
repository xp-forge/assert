<?php namespace unittest\assert\unittest;

use lang\Object;
use unittest\assert\Assertions;

/**
 * Tests `extracting()` method.
 */
class ExtractingTest extends AbstractAssertionsTest {

  /** @return var[][] */
  protected function people() {
    return [
      [['id' => 1, 'name' => 'Test', 'age' => 42, 'department' => ['name' => 'Test']]],
      [newinstance(Object::class, [], [
        'id'            => 1,
        'name'          => 'Test',
        'age'           => 42,
        'department'    => ['name' => 'Test']
      ])],
      [newinstance(Object::class, [], [
        'id'            => function() { return 1; },
        'name'          => function() { return 'Test'; },
        'age'           => function() { return 42; },
        'department'    => function() { return ['name' => 'Test']; }
      ])],
      [newinstance(Object::class, [], [
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
    $this->assertVerified(Assertions::of($person)->extracting('name')->isEqualTo('Test'));
  }

  #[@test, @values('people')]
  public function extracting_multiple($person) {
    $this->assertVerified(Assertions::of($person)->extracting(['name', 'age'])->isEqualTo(['Test', 42]));
  }

  #[@test, @values('people')]
  public function extracting_by_name($person) {
    $this->assertVerified(Assertions::of($person)->extracting(['key' => 'id'])->isEqualTo(['key' => 1]));
  }

  #[@test, @values('people')]
  public function extracting_chained($person) {
    $this->assertVerified(Assertions::of($person)->extracting('department')->extracting('name')->isEqualTo('Test'));
  }

  #[@test, @values('people')]
  public function extracting_from_array($person) {
    $this->assertVerified(Assertions::of([$person, $person])->extracting('name')->isEqualTo(['Test', 'Test']));
  }

  #[@test]
  public function extracting_from_instance_via_closure() {
    $this->assertVerified(Assertions::of(new Person(1, 'Test', 42, ['name' => 'Test']))
      ->extracting(function($person) { return $person->name(); })
      ->isEqualTo('Test')
    );
  }

  #[@test]
  public function extracting_from_map_via_closure() {
    $this->assertVerified(Assertions::of(['id' => 1, 'name' => 'Test'])
      ->extracting(function($person) { return $person['name']; })
      ->isEqualTo('Test')
    );
  }

  #[@test]
  public function extracting_from_map_via_array_of_string_and_closure() {
    $this->assertVerified(Assertions::of(['id' => 1, 'name' => 'Test'])
      ->extracting([function($person) { return $person['name']; }, 'id'])
      ->isEqualTo(['Test', 1])
    );
  }
}