<?php

namespace Marando\IAU;

trait iauUtctai {

  /**
   *  - - - - - - - - - -
   *   i a u U t c t a i
   *  - - - - - - - - - -
   *
   *  Time scale transformation:  Coordinated Universal Time, UTC, to
   *  International Atomic Time, TAI.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  canonical.
   *
   *  Given:
   *     utc1,utc2  double   UTC as a 2-part quasi Julian Date (Notes 1-4)
   *
   *  Returned:
   *     tai1,tai2  double   TAI as a 2-part Julian Date (Note 5)
   *
   *  Returned (function value):
   *                int      status: +1 = dubious year (Note 3)
   *                                  0 = OK
   *                                 -1 = unacceptable date
   *
   *  Notes:
   *
   *  1) utc1+utc2 is quasi Julian Date (see Note 2), apportioned in any
   *     convenient way between the two arguments, for example where utc1
   *     is the Julian Day Number and utc2 is the fraction of a day.
   *
   *  2) JD cannot unambiguously represent UTC during a leap second unless
   *     special measures are taken.  The convention in the present
   *     function is that the JD day represents UTC days whether the
   *     length is 86399, 86400 or 86401 SI seconds.  In the 1960-1972 era
   *     there were smaller jumps (in either direction) each time the
   *     linear UTC(TAI) expression was changed, and these "mini-leaps"
   *     are also included in the SOFA convention.
   *
   *  3) The warning status "dubious year" flags UTCs that predate the
   *     introduction of the time scale or that are too far in the future
   *     to be trusted.  See iauDat for further details.
   *
   *  4) The function iauDtf2d converts from calendar date and time of day
   *     into 2-part Julian Date, and in the case of UTC implements the
   *     leap-second-ambiguity convention described above.
   *
   *  5) The returned TAI1,TAI2 are such that their sum is the TAI Julian
   *     Date.
   *
   *  Called:
   *     iauJd2cal    JD to Gregorian calendar
   *     iauDat       delta(AT) = TAI-UTC
   *     iauCal2jd    Gregorian calendar to JD
   *
   *  References:
   *
   *     McCarthy, D. D., Petit, G. (eds.), IERS Conventions (2003),
   *     IERS Technical Note No. 32, BKG (2004)
   *
   *     Explanatory Supplement to the Astronomical Almanac,
   *     P. Kenneth Seidelmann (ed), University Science Books (1992)
   *
   *  This revision:  2013 July 26
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   *
   */
  public static function Utctai($utc1, $utc2, &$tai1, &$tai2) {
    $big1;
    $iy;
    $im;
    $id;
    $j;
    $iyt;
    $imt;
    $idt;
    $u1;
    $u2;
    $fd;
    $dat0;
    $dat12;
    $w;
    $dat24;
    $dlod;
    $dleap;
    $z1;
    $z2;
    $a2;

    /* Put the two parts of the UTC into big-first order. */
    $big1 = ( $utc1 >= $utc2 );
    if ($big1) {
      $u1 = $utc1;
      $u2 = $utc2;
    }
    else {
      $u1 = $utc2;
      $u2 = $utc1;
    }

    /* Get TAI-UTC at 0h today. */
    $j = IAU::Jd2cal($u1, $u2, $iy, $im, $id, $fd);
    if ($j !=0 )
      return j;
    $j = IAU::Dat($iy, $im, $id, 0.0, $dat0);
    if ($j < 0)
      return $j;

    /* Get TAI-UTC at 12h today (to detect drift). */
    $j = IAU::Dat($iy, $im, $id, 0.5, $dat12);
    if ($j < 0)
      return $j;

    /* Get TAI-UTC at 0h tomorrow (to detect jumps). */
    $j = IAU::Jd2cal($u1 + 1.5, $u2 - $fd, $iyt, $imt, $idt, $w);
    if ($j!=0)
      return $j;
    $j = IAU::Dat($iyt, $imt, $idt, 0.0, $dat24);
    if ($j < 0)
      return $j;

    /* Separate TAI-UTC change into per-day (DLOD) and any jump (DLEAP). */
    $dlod  = 2.0 * ($dat12 - $dat0);
    $dleap = $dat24 - ($dat0 + $dlod);

    /* Remove any scaling applied to spread leap into preceding day. */
    $fd *= (DAYSEC + $dleap) / DAYSEC;

    /* Scale from (pre-1972) UTC seconds to SI seconds. */
    $fd *= (DAYSEC + $dlod) / DAYSEC;

    /* Today's calendar date to 2-part JD. */
    if (IAU::Cal2jd($iy, $im, $id, $z1, $z2))
      return -1;

    /* Assemble the TAI result, preserving the UTC split and order. */
    $a2 = $z1 - $u1;
    $a2 += $z2;
    $a2 += $fd + $dat0 / DAYSEC;
    if ($big1) {
      $tai1 = $u1;
      $tai2 = $a2;
    }
    else {
      $tai1 = $a2;
      $tai2 = $u1;
    }

    /* Status. */
    return $j;
  }

}
