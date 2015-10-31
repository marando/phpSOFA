<?php

namespace Marando\IAU;

trait iauCal2jd {

  /**
   *  - - - - - - - - - -
   *   i a u C a l 2 j d
   *  - - - - - - - - - -
   *
   *  Gregorian Calendar to Julian Date.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     iy,im,id  int     year, month, day in Gregorian calendar (Note 1)
   *
   *  Returned:
   *     djm0      double  MJD zero-point: always 2400000.5
   *     djm       double  Modified Julian Date for 0 hrs
   *
   *  Returned (function value):
   *               int     status:
   *                           0 = OK
   *                          -1 = bad year   (Note 3: JD not computed)
   *                          -2 = bad month  (JD not computed)
   *                          -3 = bad day    (JD computed)
   *
   *  Notes:
   *
   *  1) The algorithm used is valid from -4800 March 1, but this
   *     implementation rejects dates before -4799 January 1.
   *
   *  2) The Julian Date is returned in two pieces, in the usual SOFA
   *     manner, which is designed to preserve time resolution.  The
   *     Julian Date is available as a single number by adding djm0 and
   *     djm.
   *
   *  3) In early eras the conversion is from the "Proleptic Gregorian
   *     Calendar";  no account is taken of the date(s) of adoption of
   *     the Gregorian Calendar, nor is the AD/BC numbering convention
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
  public static function Cal2jd($iy, $im, $id, &$djm0, &$djm) {
    $j;
    $ly;
    $my;
    $iypmy;

    /* Earliest year allowed (4800BC) */
    $IYMIN = -4799;

    /* Month lengths in days */
    $mtab = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    /* Preset status. */
    $j = 0;

    /* Validate year and month. */
    if ($iy < $IYMIN)
      return -1;
    if ($im < 1 || $im > 12)
      return -2;

    /* If February in a leap year, 1, otherwise 0. */
    $ly = (($im == 2) && !($iy % 4) && ($iy % 100 || !($iy % 400)));

    /* Validate day, taking into account leap years. */
    if (($id < 1) || ($id > ($mtab[$im - 1] + $ly)))
      $j = -3;

    /* Return result. */
    $my    = intval(($im - 14) / 12);
    $iypmy = intval($iy + $my);
    $djm0  = DJM0;
    $djm   = (double)( intval((1461 * ($iypmy + 4800)) / 4) +
            intval((367 * intval($im - 2 - 12 * $my)) / 12) -
            intval((3 * ( intval(($iypmy + 4900) / 100) )) / 4) +
            intval($id - 2432076));

    /* Return status. */
    return $j;
  }

}
