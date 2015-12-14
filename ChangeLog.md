Data sequences change log
=========================

## ?.?.? / ????-??-??

## 1.0.0 / 2015-12-14

* **Heads up**: Changed minimum XP version to run webtests to XP
  6.5.0, and with it the minimum PHP version to PHP 5.5
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
