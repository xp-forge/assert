<?php namespace unittest\assert;;

use unittest\AssertionFailedError;
use unittest\FormattedMessage;
use util\Objects;

class AssertionsFailed extends \lang\Object {
  public static $EMPTY;
  protected $failures= [];

  static function __static() {
    self::$EMPTY= new self();
  }

  /** 
   * Adds an error
   *
   * @param  unittest.AssertionfailuresError $e
   * @return void
   */
  public function add(AssertionFailedError $e) {
    $this->failures[]= $e;
  }

  /** @return bool */
  public function isEmpty() {return empty($this->failures); }

  /** @return unittest.AssertionfailuresError[] */
  public function failures() { return $this->failures; }

  public function raiseIf() {
    switch (sizeof($this->failures)) {
      case 0: return;
      case 1: throw $this->failures[0];
      default: {
        $list= '';
        foreach ($this->failures as $i => $failures) {
          $list.= '  '.($i + 1).': '.$failures->compoundMessage()."\n";
        }
        throw new AssertionfailuresError(new FormattedMessage(
          "The following %d assertions failures:\n%s",
          [$i + 1, $list]
        ));
      }
    }
  }

  public function equals($cmp) {
    return $cmp instanceof self && Objects::equal($cmp->failures, $this->failures);
  }
}