<?php namespace unittest\assert;

use lang\types\ArrayList;
use lang\types\String;

abstract class Assert extends \lang\Object {

  public static function that($value) {
    if (is_array($value)) {
      $assert= new ArrayPrimitiveValue($value);
    } else if (is_string($value)) {
      $assert= new StringPrimitiveValue($value);
    } else if ($value instanceof ArrayList) {
      $assert= new ArrayValue($value);
    } else if ($value instanceof String) {
      $assert= new StringValue($value);
    } else {
      $assert= new Value($value);
    }

    return Assertions::verifyThat($assert);
  }
}