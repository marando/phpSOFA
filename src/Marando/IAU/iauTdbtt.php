<?php

namespace Marando\IAU;

trait iauTdbtt {

  /**
   *  - - - - - - - - -
   *   i a u T d b t t
   *  - - - - - - - - -
   *
   *  Time scale transformation:  Barycentric Dynamical Time, TDB, to
   *  Terrestrial Time, TT.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  canonical.
   *
   *  Given:
   *     tdb1,tdb2  double    TDB as a 2-part Julian Date
   *     dtr        double    TDB-TT in seconds
   *
   *  Returned:
   *     tt1,tt2    double    TT as a 2-part Julian Date
   *
   *  Returned (function value):
   *                int       status:  0 = OK
   *
   *  Notes:
   *
   *  1) tdb1+tdb2 is Julian Date, apportioned in any convenient way
   *     between the two arguments, for example where tdb1 is the Julian
   *     Day Number and tdb2 is the fraction of a day.  The returned
   *     tt1,tt2 follow suit.
   *
   *  2) The argument dtr represents the quasi-periodic component of the
   *     GR transformation between TT and TCB.  It is dependent upon the
   *     adopted solar-system ephemeris, and can be obtained by numerical
   *     integration, by interrogating a precomputed time ephemeris or by
   *     evaluating a model such as that implemented in the SOFA function
   *     iauDtdb.   The quantity is dominated by an annual term of 1.7 ms
   *     amplitude.
   *
   *  3) TDB is essentially the same as Teph, the time argument for the
   *     JPL solar system ephemerides.
   *
   *  References:
   *
   *     McCarthy, D. D., Petit, G. (eds.), IERS Conventions (2003),
   *     IERS Technical Note No. 32, BKG (2004)
   *
   *     IAU 2006 Resolution 3
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   *
   */
  public static function Tdbtt($tdb1, $tdb2, $dtr, &$tt1, &$tt2) {
    $dtrd;

    /* Result, safeguarding precision. */
    $dtrd = $dtr / DAYSEC;
    if ($tdb1 > $tdb2) {
      $tt1 = $tdb1;
      $tt2 = $tdb2 - $dtrd;
    }
    else {
      $tt1 = $tdb1 - $dtrd;
      $tt2 = $tdb2;
    }

    /* Status (always OK). */
    return 0;
  }

}
