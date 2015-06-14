<?php namespace unittest\assert;

class NumericValue extends Value {

  public function isGreaterThan($comparison) {
    return $this->is(new Match(
      function($value) use($comparison) { return $value > $comparison; },
      ['%s is not greater than'.$comparison, '%s is greater than '.$comparison]
    ));
  }

  public function isLessThan($comparison) {
    return $this->is(new Match(
      function($value) use($comparison) { return $value < $comparison; },
      ['%s is not less than'.$comparison, '%s is less than '.$comparison]
    ));
  }

  public function isBetween($start, $end) {
    return $this->is(new Match(
      function($value) use($start, $end) { return $value >= $start && $value <= $end; },
      ['%s is not between '.$start.' and '.$end, '%s is between '.$start.' and '.$end]
    ));
  }

  public function isCloseTo($comparison, $tolerance) {
    $within= '(within a tolerance of '.$tolerance.')';
    return $this->is(new Match(
      function($value) use($comparison, $tolerance) { return abs($value - $comparison) <= $tolerance; },
      ['%s is not close to '.$comparison.' '.$within, '%s is close to '.$comparison.' '.$within]
    ));
  }
}