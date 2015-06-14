Data sequences change log
=========================

## ?.?.? / ????-??-??

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
