<?php

namespace Marando\IAU;

trait iauDtf2d {

  /**
   *  - - - - - - - - -
   *   i a u D t f 2 d
   *  - - - - - - - - -
   *
   *  Encode date and time fields into 2-part Julian Date (or in the case
   *  of UTC a quasi-JD form that includes special provision for leap
   *  seconds).
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     scale     char[]  time scale ID (Note 1)
   *     iy,im,id  int     year, month, day in Gregorian calendar (Note 2)
   *     ihr,imn   int     hour, minute
   *     sec       double  seconds
   *
   *  Returned:
   *     d1,d2     double  2-part Julian Date (Notes 3,4)
   *
   *  Returned (function value):
   *               int     status: +3 = both of next two
   *                               +2 = time is after end of day (Note 5)
   *                               +1 = dubious year (Note 6)
   *                                0 = OK
   *                               -1 = bad year
   *                               -2 = bad month
   *                               -3 = bad day
   *                               -4 = bad hour
   *                               -5 = bad minute
   *                               -6 = bad second (<0)
   *
   *  Notes:
   *
   *  1) scale identifies the time scale.  Only the value "UTC" (in upper
   *     case) is significant, and enables handling of leap seconds (see
   *     Note 4).
   *
   *  2) For calendar conventions and limitations, see iauCal2jd.
   *
   *  3) The sum of the results, d1+d2, is Julian Date, where normally d1
   *     is the Julian Day Number and d2 is the fraction of a day.  In the
   *     case of UTC, where the use of JD is problematical, special
   *     conventions apply:  see the next note.
   *
   *  4) JD cannot unambiguously represent UTC during a leap second unless
   *     special measures are taken.  The SOFA internal convention is that
   *     the quasi-JD day represents UTC days whether the length is 86399,
   *     86400 or 86401 SI seconds.  In the 1960-1972 era there were
   *     smaller jumps (in either direction) each time the linear UTC(TAI)
   *     expression was changed, and these "mini-leaps" are also included
   *     in the SOFA convention.
   *
   *  5) The warning status "time is after end of day" usually means that
   *     the sec argument is greater than 60.0.  However, in a day ending
   *     in a leap second the limit changes to 61.0 (or 59.0 in the case
   *     of a negative leap second).
   *
   *  6) The warning status "dubious year" flags UTCs that predate the
   *     introduction of the time scale or that are too far in the future
   *     to be trusted.  See iauDat for further details.
   *
   *  7) Only in the case of continuous and regular time scales (TAI, TT,
   *     TCG, TCB and TDB) is the result d1+d2 a Julian Date, strictly
   *     speaking.  In the other cases (UT1 and UTC) the result must be
   *     used with circumspection;  in particular the difference between
   *     two such results cannot be interpreted as a precise time
   *     interval.
   *
   *  Called:
   *     iauCal2jd    Gregorian calendar to JD
   *     iauDat       delta(AT) = TAI-UTC
   *     iauJd2cal    JD to Gregorian calendar
   *
   *  This revision:  2013 July 26
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Dtf2d($scale, $iy, $im, $id, $ihr, $imn, $sec, &$d1,
          &$d2) {

    $js;
    $iy2;
    $im2;
    $id2;
    $dj;
    $w;
    $day;
    $seclim;
    $dat0;
    $dat12;
    $dat24;
    $dleap;
    $time;

    /* Today's Julian Day Number. */
    $js = IAU::Cal2jd($iy, $im, $id, $dj, $w);
    if ($js)
      return $js;
    $dj += $w;

    /* Day length and final minute length in seconds (provisional). */
    $day    = DAYSEC;
    $seclim = 60.0;

    /* Deal with the UTC leap second case. */
    if (!strcmp($scale, "UTC")) {

      /* TAI-UTC at 0h today. */
      $js = IAU::Dat($iy, $im, $id, 0.0, $dat0);
      if ($js < 0)
        return $js;

      /* TAI-UTC at 12h today (to detect drift). */
      $js = IAU::Dat($iy, $im, $id, 0.5, $dat12);
      if ($js < 0)
        return $js;

      /* TAI-UTC at 0h tomorrow (to detect jumps). */
      $js = IAU::Jd2cal($dj, 1.5, $iy2, $im2, $id2, $w);
      if ($js)
        return js;
      $js = IAU::Dat($iy2, $im2, $id2, 0.0, $dat24);
      if ($js < 0)
        return $js;

      /* Any sudden change in TAI-UTC between today and tomorrow. */
      $dleap = $dat24 - (2.0 * $dat12 - $dat0);

      /* If leap second day, correct the day and final minute lengths. */
      $day += $dleap;
      if ($ihr == 23 && $imn == 59)
        $seclim += $dleap;

      /* End of UTC-specific actions. */
    }

    /* Validate the time. */
    if ($ihr >= 0 && $ihr <= 23) {
      if ($imn >= 0 && $imn <= 59) {
        if ($sec >= 0) {
          if ($sec >= $seclim) {
            $js += 2;
          }
        }
        else {
          $js = -6;
        }
      }
      else {
        $js = -5;
      }
    }
    else {
      $js = -4;
    }
    if ($js < 0)
      return $js;

    /* The time in days. */
    $time = ( 60.0 * ( (double)( 60 * $ihr + $imn ) ) + $sec ) / $day;

    /* Return the date and time. */
    $d1 = $dj;
    $d2 = $time;

    /* Status. */
    return $js;
  }

}
