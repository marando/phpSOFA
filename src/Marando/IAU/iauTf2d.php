<?php

namespace Marando\IAU;

trait iauTf2d {

  /**
   *  - - - - - - - -
   *   i a u T f 2 d
   *  - - - - - - - -
   *
   *  Convert hours, minutes, seconds to days.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     s         char    sign:  '-' = negative, otherwise positive
   *     ihour     int     hours
   *     imin      int     minutes
   *     sec       double  seconds
   *
   *  Returned:
   *     days      double  interval in days
   *
   *  Returned (function value):
   *               int     status:  0 = OK
   *                                1 = ihour outside range 0-23
   *                                2 = imin outside range 0-59
   *                                3 = sec outside range 0-59.999...
   *
   *  Notes:
   *
   *  1)  The result is computed even if any of the range checks fail.
   *
   *  2)  Negative ihour, imin and/or sec produce a warning status, but
   *      the absolute value is used in the conversion.
   *
   *  3)  If there are multiple errors, the status value reflects only the
   *      first, the smallest taking precedence.
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Tf2d($s, $ihour, $imin, $sec, &$days) {
    /* Compute the interval. */
    $days = ( $s == '-' ? -1.0 : 1.0 ) *
            ( 60.0 * ( 60.0 * ( (double)abs($ihour) ) +
            ( (double)abs($imin) ) ) +
            abs($sec) ) / DAYSEC;

    /* Validate arguments and return status. */
    if ($ihour < 0 || $ihour > 23)
      return 1;
    if ($imin < 0 || $imin > 59)
      return 2;
    if ($sec < 0.0 || $sec >= 60.0)
      return 3;
    return 0;
  }

}
