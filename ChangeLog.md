Assertions change log
=====================

## ?.?.? / ????-??-??

## 4.1.2 / 2022-02-27

* Fixed "Creation of dynamic property" warnings in PHP 8.2 - @thekid

## 4.1.1 / 2021-10-25

* Made library compatible with XP 11 - @thekid

## 4.1.0 / 2020-10-03

* Fixed PHP 8 compatibility by renaming (the internally used) class
  `unittest.assert.Match` class to *MatchUsing*. PHP 8 defines match as
  a keyword, see https://wiki.php.net/rfc/match_expression_v2
  (@thekid)

## 4.0.0 / 2020-04-10

* Implemented xp-framework/rfc#334: Drop PHP 5.6:
  . **Heads up:** Minimum required PHP version now is PHP 7.0.0
  . Rewrote code base, grouping use statements
  . Converted `newinstance` to anonymous classes
  (@thekid)

## 3.0.3 / 2020-04-05

* Implemented RFC #335: Remove deprecated key/value pair annotation syntax
  (@thekid)

## 3.0.2 / 2020-04-05

* Made compatible with XP 10 - @thekid

## 3.0.1 / 2018-04-02

* Fixed compatiblity with PHP 7.2 - @thekid

## 3.0.0 / 2017-06-04

* **Heads up:** Dropped PHP 5.5 support - @thekid
* Added forward compatibility with XP 9.0.0 - @thekid

## 2.1.0 / 2017-04-12

* Added version compatibility with XP 8 - @thekid

## 2.0.0 / 2016-02-21

* Added version compatibility with XP 7 - @thekid

## 1.0.0 / 2015-12-14

* **Heads up**: Changed minimum XP version to XP 6.5.0, and with it the
  minimum PHP version to PHP 5.5.
  (@thekid)

## 0.8.0 / 2015-06-15

* **Heads up: Competely rewrote inner workings**
  Most important, the first assertion failing will trigger a failure.
  For cases when we want all assertions to be executed, we now need to 
  wrap them in a function and pass that to `All::of()`. This way, we do
  not need the `#[@action(new Assertions())]` anymore!
  (@thekid)
* Renamed all *Value* classes are now called *Assertions*
  (@thekid)
* Added possibility to name elements in `extracting()` by passing
  a map instead of an array.
  (@thekid)
* Made it possible to supply closures to `extracting()`. See PR #6
  (@thekid)
* Added `isEmpty()` assertion for strings, arrays and maps. See PR #5
  (@thekid)
* Added numeric assertions isGreaterThan(), isLessThan(), isBetween()
  and isCloseTo(). See PR #4
  (@thekid)

## 0.7.0 / 2015-06-14

* **Heads up: Removed support for lang.types wrapper types** - @thekid
* Added forward compatibility with PHP7 - @thekid

## 0.6.2 / 2015-02-12

* Changed dependency to use XP ~6.0 (instead of dev-master) - @thekid

## 0.6.1 / 2015-01-10

* Fixed issue #2 by changing precedence in which extraction accesses
  properties: Accessor methods first, then properties directly
  (@thekid)

## 0.6.0 / 2015-01-10

* Made available via Composer - @thekid

## 0.5.1 / 2014-09-23

* First public release - @thekid
