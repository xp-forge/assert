<?php namespace unittest\assert\unittest;

use unittest\assert\Assertions;
use unittest\{Test, Values};

/**
 * Tests `extracting()` method.
 */
class ExtractingTest extends AbstractAssertionsTest {

  /** @return var[][] */
  protected function people() {
    return [
      [['id' => 1, 'name' => 'Test', 'age' => 42, 'department' => ['name' => 'Test']]],
      [new class('Test') extends Name {
        public $id= 1;
        public $name= 'Test';
        public $age= 42;
        public $department= ['name' => 'Test'];
      }],
      [new class('Test') extends Name {
        public function id() { return 1; }
        public function name() { return 'Test'; }
        public function age() { return 42; }
        public function department() { return ['name' => 'Test']; }
      }],
      [new class('Test') extends Name {
        public function getId() { return 1; }
        public function getName() { return 'Test'; }
        public function getAge() { return 42; }
        public function getDepartment() { return ['name' => 'Test']; }
      }],
      [new Person(1, 'Test', 42, ['name' => 'Test'])]
    ];
  }

  #[Test, Values('people')]
  public function extracting($person) {
    $this->assertVerified(Assertions::of($person)->extracting('name')->isEqualTo('Test'));
  }

  #[Test, Values('people')]
  public function extracting_multiple($person) {
    $this->assertVerified(Assertions::of($person)->extracting(['name', 'age'])->isEqualTo(['Test', 42]));
  }

  #[Test, Values('people')]
  public function extracting_by_name($person) {
    $this->assertVerified(Assertions::of($person)->extracting(['key' => 'id'])->isEqualTo(['key' => 1]));
  }

  #[Test, Values('people')]
  public function extracting_chained($person) {
    $this->assertVerified(Assertions::of($person)->extracting('department')->extracting('name')->isEqualTo('Test'));
  }

  #[Test, Values('people')]
  public function extracting_from_array($person) {
    $this->assertVerified(Assertions::of([$person, $person])->extracting('name')->isEqualTo(['Test', 'Test']));
  }

  #[Test]
  public function extracting_from_instance_via_closure() {
    $this->assertVerified(Assertions::of(new Person(1, 'Test', 42, ['name' => 'Test']))
      ->extracting(function($person) { return $person->name(); })
      ->isEqualTo('Test')
    );
  }

  #[Test]
  public function extracting_from_map_via_closure() {
    $this->assertVerified(Assertions::of(['id' => 1, 'name' => 'Test'])
      ->extracting(function($person) { return $person['name']; })
      ->isEqualTo('Test')
    );
  }

  #[Test]
  public function extracting_from_map_via_array_of_string_and_closure() {
    $this->assertVerified(Assertions::of(['id' => 1, 'name' => 'Test'])
      ->extracting([function($person) { return $person['name']; }, 'id'])
      ->isEqualTo(['Test', 1])
    );
  }
}