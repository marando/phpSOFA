<?php

namespace Marando\IAU;

trait iauTcgtt {

  /**
   *  - - - - - - - - -
   *   i a u T c g t t
   *  - - - - - - - - -
   *
   *  Time scale transformation:  Geocentric Coordinate Time, TCG, to
   *  Terrestrial Time, TT.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  canonical.
   *
   *  Given:
   *     tcg1,tcg2  double    TCG as a 2-part Julian Date
   *
   *  Returned:
   *     tt1,tt2    double    TT as a 2-part Julian Date
   *
   *  Returned (function value):
   *                int       status:  0 = OK
   *
   *  Note:
   *
   *     tcg1+tcg2 is Julian Date, apportioned in any convenient way
   *     between the two arguments, for example where tcg1 is the Julian
   *     Day Number and tcg22 is the fraction of a day.  The returned
   *     tt1,tt2 follow suit.
   *
   *  References:
   *
   *     McCarthy, D. D., Petit, G. (eds.), IERS Conventions (2003),.
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
  public static function Tcgtt($tcg1, $tcg2, &$tt1, &$tt2) {
    /* 1977 Jan 1 00:00:32.184 TT, as MJD */
    $t77t = DJM77 + TTMTAI / DAYSEC;

    /* Result, safeguarding precision. */
    if ($tcg1 > $tcg2) {
      $tt1 = $tcg1;
      $tt2 = $tcg2 - ( ( $tcg1 - DJM0 ) + ( $tcg2 - $t77t ) ) * ELG;
    }
    else {
      $tt1 = $tcg1 - ( ( $tcg2 - DJM0 ) + ( $tcg1 - $t77t ) ) * ELG;
      $tt2 = $tcg2;
    }

    /* OK status. */
    return 0;
  }

}
