<?php

namespace Marando\IAU;

trait iauJd2cal {

  /**
   *  - - - - - - - - - -
   *   i a u J d 2 c a l
   *  - - - - - - - - - -
   *
   *  Julian Date to Gregorian year, month, day, and fraction of a day.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     dj1,dj2   double   Julian Date (Notes 1, 2)
   *
   *  Returned (arguments):
   *     iy        int      year
   *     im        int      month
   *     id        int      day
   *     fd        double   fraction of day
   *
   *  Returned (function value):
   *               int      status:
   *                           0 = OK
   *                          -1 = unacceptable date (Note 3)
   *
   *  Notes:
   *
   *  1) The earliest valid date is -68569.5 (-4900 March 1).  The
   *     largest value accepted is 1e9.
   *
   *  2) The Julian Date is apportioned in any convenient way between
   *     the arguments dj1 and dj2.  For example, JD=2450123.7 could
   *     be expressed in any of these ways, among others:
   *
   *            dj1             dj2
   *
   *         2450123.7           0.0       (JD method)
   *         2451545.0       -1421.3       (J2000 method)
   *         2400000.5       50123.2       (MJD method)
   *         2450123.5           0.2       (date & time method)
   *
   *  3) In early eras the conversion is from the "proleptic Gregorian
   *     calendar";  no account is taken of the date(s) of adoption of
   *     the Gregorian calendar, nor is the AD/BC numbering convention
   *     observed.
   *
   *  Reference:
   *
   *     Explanatory Supplement to the Astronomical Almanac,
   *     P. Kenneth Seidelmann (ed), University Science Books (1992),
   *     Section 12.92 (p604).
   *
   *  This revision:  2013 August 7
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Jd2cal($dj1, $dj2, &$iy, &$im, &$id, &$fd) {
    /* Minimum and maximum allowed JD */
    $DJMIN = -68569.5;
    $DJMAX = 1e9;

    $jd;
    $l;
    $n;
    $i;
    $k;
    $dj;
    $d1;
    $d2;
    $f1;
    $f2;
    $f;
    $d;

    /* Verify date is acceptable. */
    $dj = $dj1 + $dj2;
    if ($dj < $DJMIN || $dj > $DJMAX)
      return -1;

    /* Copy the date, big then small, and re-align to midnight. */
    if ($dj1 >= $dj2) {
      $d1 = $dj1;
      $d2 = $dj2;
    }
    else {
      $d1 = $dj2;
      $d2 = $dj1;
    }
    $d2 -= 0.5;

    /* Separate day and fraction. */
    $f1 = fmod($d1, 1.0);
    $f2 = fmod($d2, 1.0);
    $f  = fmod($f1 + $f2, 1.0);
    if ($f < 0.0)
      $f += 1.0;
    $d  = floor($d1 - $f1) + floor($d2 - $f2) + floor($f1 + $f2 - $f);
    $jd = floor($d) + 1;

    /* Express day in Gregorian calendar. */
    // Integer division parts of this block was modified in the PHP translation
    $l  = $jd + 68569;
    $n  = floor( (int)(4 * $l) / 146097);
    $l -= floor( (int)(146097 * $n + 3) / 4);
    $i  = floor( (int)(4000 * ($l + 1)) / 1461001);
    $l -= floor( (int)(1461 * $i) / 4) - 31;
    $k  = floor( (int)(80 * $l) / 2447);
    $id = ($l - floor((int)(2447 * $k) / 80));
    $l  = floor((int)$k / 11);
    $im = (int)($k + 2 - 12 * $l);
    $iy = (int)(100 * ($n - 49) + $i + $l);
    $fd = $f;

    return 0;
  }

}
