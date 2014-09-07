<?php namespace unittest\assert;

interface Condition {

  public function matches($value);
}