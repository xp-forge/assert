<?php namespace unittest\assert;;

use unittest\AssertionFailedError;
use unittest\FormattedMessage;

class AssertionsFailed extends \lang\Object {
  protected $failed= [];

  public function add(AssertionFailedError $e) {
    $this->failed[]= $e;
  }

  public function isEmpty() {
    return empty($this->failed);
  }

  public function raiseIf() {
    switch (sizeof($this->failed)) {
      case 0: return;
      case 1: throw $this->failed[0];
      default: {
        $list= '';
        foreach ($this->failed as $i => $failed) {
          $list.= '  '.($i + 1).': '.$failed->compoundMessage()."\n";
        }
        throw new AssertionFailedError(new FormattedMessage(
          "The following %d assertions failed:\n%s",
          [$i + 1, $list]
        ));
      }
    }
  }
}