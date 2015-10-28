<?php

namespace Marando\IAU;

trait iauAf2a {

  /**
   *  - - - - - - - -
   *   i a u A f 2 a
   *  - - - - - - - -
   *
   *  Convert degrees, arcminutes, arcseconds to radians.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     s         char    sign:  '-' = negative, otherwise positive
   *     ideg      int     degrees
   *     iamin     int     arcminutes
   *     asec      double  arcseconds
   *
   *  Returned:
   *     rad       double  angle in radians
   *
   *  Returned (function value):
   *               int     status:  0 = OK
   *                                1 = ideg outside range 0-359
   *                                2 = iamin outside range 0-59
   *                                3 = asec outside range 0-59.999...
   *
   *  Notes:
   *
   *  1)  The result is computed even if any of the range checks fail.
   *
   *  2)  Negative ideg, iamin and/or asec produce a warning status, but
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
  public static function iauAf2a($s, $ideg, $iamin, $asec, &$rad) {
    /* Compute the interval. */
    $rad = ( $s == '-' ? -1.0 : 1.0 ) *
            ( 60.0 * ( 60.0 * ( (double)abs($ideg) ) +
            ( (double)abs($iamin) ) ) +
            abs($asec) ) * DAS2R;

    /* Validate arguments and return status. */
    if ($ideg < 0 || $ideg > 359)
      return 1;
    if ($iamin < 0 || $iamin > 59)
      return 2;
    if ($asec < 0.0 || $asec >= 60.0)
      return 3;
    return 0;
  }

}
