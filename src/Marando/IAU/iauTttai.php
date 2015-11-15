<?php

namespace Marando\IAU;

trait iauTttai {

  /**
   *  - - - - - - - - -
   *   i a u T t t a i
   *  - - - - - - - - -
   *
   *  Time scale transformation:  Terrestrial Time, TT, to International
   *  Atomic Time, TAI.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  canonical.
   *
   *  Given:
   *     tt1,tt2    double    TT as a 2-part Julian Date
   *
   *  Returned:
   *     tai1,tai2  double    TAI as a 2-part Julian Date
   *
   *  Returned (function value):
   *                int       status:  0 = OK
   *
   *  Note:
   *
   *     tt1+tt2 is Julian Date, apportioned in any convenient way between
   *     the two arguments, for example where tt1 is the Julian Day Number
   *     and tt2 is the fraction of a day.  The returned tai1,tai2 follow
   *     suit.
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
  public static function Tttai($tt1, $tt2, &$tai1, &$tai2) {
    /* TT minus TAI (days). */
    $dtat = TTMTAI / DAYSEC;

    /* Result, safeguarding precision. */
    if ($tt1 > $tt2) {
      $tai1 = $tt1;
      $tai2 = $tt2 - $dtat;
    }
    else {
      $tai1 = $tt1 - $dtat;
      $tai2 = $tt2;
    }

    /* Status (always OK). */
    return 0;
  }

}
