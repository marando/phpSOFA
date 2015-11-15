<?php

namespace Marando\IAU;

trait iauTtut1 {

  /**
   *  - - - - - - - - -
   *   i a u T t u t 1
   *  - - - - - - - - -
   *
   *  Time scale transformation:  Terrestrial Time, TT, to Universal Time,
   *  UT1.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  canonical.
   *
   *  Given:
   *     tt1,tt2    double    TT as a 2-part Julian Date
   *     dt         double    TT-UT1 in seconds
   *
   *  Returned:
   *     ut11,ut12  double    UT1 as a 2-part Julian Date
   *
   *  Returned (function value):
   *                int       status:  0 = OK
   *
   *  Notes:
   *
   *  1) tt1+tt2 is Julian Date, apportioned in any convenient way between
   *     the two arguments, for example where tt1 is the Julian Day Number
   *     and tt2 is the fraction of a day.  The returned ut11,ut12 follow
   *     suit.
   *
   *  2) The argument dt is classical Delta T.
   *
   *  Reference:
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
  public static function Ttut1($tt1, $tt2, $dt, &$ut11, &$ut12) {
    $dtd;

    /* Result, safeguarding precision. */
    $dtd = $dt / DAYSEC;
    if ($tt1 > $tt2) {
      $ut11 = $tt1;
      $ut12 = $tt2 - $dtd;
    }
    else {
      $ut11 = $tt1 - $dtd;
      $ut12 = $tt2;
    }

    /* Status (always OK). */
    return 0;
  }

}
