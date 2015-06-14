<?php namespace unittest\assert;

class StringAssertions extends Assertions {

  public function hasSize($size) {
    return $this->is(new Match(
      function($value) use($size) { return strlen($value) === $size; },
      ['%s does not have a length of '.$size, '%s has a length of '.$size]
    ));
  }

  public function isEmpty() {
    return $this->is(new Match(
      function($value) { return 0 === strlen($value); },
      ['%s is not empty', '%s is empty']
    ));
  }

  public function startsWith($string) {
    $rep= Condition::stringOf($string);
    return $this->is(new Match(
      function($value) use($string) {
        return ('' !== $value && 0 === substr_compare($value, $string, 0, strlen($string)));
      },
      ['%s does not start with '.$rep, '%s starts with '.$rep]
    ));
  }

  public function endsWith($string) {
    $rep= Condition::stringOf($string);
    return $this->is(new Match(
      function($value) use($string) {
        return ('' !== $value && 0 === substr_compare($value, $string, -strlen($string)));
      },
      ['%s does not end with '.$rep, '%s ends with '.$rep]
    ));
  }

  public function contains($string) {
    $rep= Condition::stringOf($string);
    return $this->is(new Match(
      function($value) use($string) {
        return false !== strpos($value, $string);
      },
      ['%s does not contain '.$rep, '%s contains '.$rep]
    ));
  }

  public function doesNotContain($string) {
    $rep= Condition::stringOf($string);
    return $this->isNot(new Match(
      function($value) use($string) {
        return false !== strpos($value, $string);
      },
      ['%s does not contain '.$rep, '%s contains '.$rep]
    ));
  }
}