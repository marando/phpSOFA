<?php

namespace Marando\IAU;

trait iauTttcg {

  /**
   *  - - - - - - - - -
   *   i a u T t t c g
   *  - - - - - - - - -
   *
   *  Time scale transformation:  Terrestrial Time, TT, to Geocentric
   *  Coordinate Time, TCG.
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
   *     tcg1,tcg2  double    TCG as a 2-part Julian Date
   *
   *  Returned (function value):
   *                int       status:  0 = OK
   *
   *  Note:
   *
   *     tt1+tt2 is Julian Date, apportioned in any convenient way between
   *     the two arguments, for example where tt1 is the Julian Day Number
   *     and tt2 is the fraction of a day.  The returned tcg1,tcg2 follow
   *     suit.
   *
   *  References:
   *
   *     McCarthy, D. D., Petit, G. (eds.), IERS Conventions (2003),
   *     IERS Technical Note No. 32, BKG (2004)
   *
   *     IAU 2000 Resolution B1.9
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Tttcg($tt1, $tt2, &$tcg1, &$tcg2) {
    /* 1977 Jan 1 00:00:32.184 TT, as MJD */
    $t77t = DJM77 + TTMTAI / DAYSEC;

    /* TT to TCG rate */
    $elgg = ELG / (1.0 - ELG);

    /* Result, safeguarding precision. */
    if ($tt1 > $tt2) {
      $tcg1 = $tt1;
      $tcg2 = $tt2 + ( ( $tt1 - DJM0 ) + ( $tt2 - $t77t ) ) * $elgg;
    }
    else {
      $tcg1 = $tt1 + ( ( $tt2 - DJM0 ) + ( $tt1 - $t77t ) ) * $elgg;
      $tcg2 = $tt2;
    }

    /* Status (always OK). */
    return 0;
  }

}
