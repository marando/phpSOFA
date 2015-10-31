<?php

namespace Marando\IAU;

trait iauTaitt {

  /**
   *  - - - - - - - - -
   *   i a u T a i t t
   *  - - - - - - - - -
   *
   *  Time scale transformation:  International Atomic Time, TAI, to
   *  Terrestrial Time, TT.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  canonical.
   *
   *  Given:
   *     tai1,tai2  double    TAI as a 2-part Julian Date
   *
   *  Returned:
   *     tt1,tt2    double    TT as a 2-part Julian Date
   *
   *  Returned (function value):
   *                int       status:  0 = OK
   *
   *  Note:
   *
   *     tai1+tai2 is Julian Date, apportioned in any convenient way
   *     between the two arguments, for example where tai1 is the Julian
   *     Day Number and tai2 is the fraction of a day.  The returned
   *     tt1,tt2 follow suit.
   *
   *  References:
   *
   *     McCarthy, D. D., Petit, G. (eds.), IERS Conventions (2003),
   *     IERS Technical Note No. 32, BKG (2004)
   *
   *     Explanatory Supplement to the Astronomical Almanac,
   *     P. Kenneth Seidelmann (ed), University Science Books (1992)
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Taitt($tai1, $tai2, &$tt1, &$tt2) {
    /* TT minus TAI (days). */
    $dtat = TTMTAI / DAYSEC;

    /* Result, safeguarding precision. */
    if ($tai1 > $tai2) {
      $tt1 = $tai1;
      $tt2 = $tai2 + $dtat;
    }
    else {
      $tt1 = $tai1 + $dtat;
      $tt2 = $tai2;
    }

    /* Status (always OK). */
    return 0;
  }

}
