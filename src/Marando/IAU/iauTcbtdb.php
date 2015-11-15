<?php

namespace Marando\IAU;

trait iauTcbtdb {

  /**
   *  - - - - - - - - - -
   *   i a u T c b t d b
   *  - - - - - - - - - -
   *
   *  Time scale transformation:  Barycentric Coordinate Time, TCB, to
   *  Barycentric Dynamical Time, TDB.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  canonical.
   *
   *  Given:
   *     tcb1,tcb2  double    TCB as a 2-part Julian Date
   *
   *  Returned:
   *     tdb1,tdb2  double    TDB as a 2-part Julian Date
   *
   *  Returned (function value):
   *                int       status:  0 = OK
   *
   *  Notes:
   *
   *  1) tcb1+tcb2 is Julian Date, apportioned in any convenient way
   *     between the two arguments, for example where tcb1 is the Julian
   *     Day Number and tcb2 is the fraction of a day.  The returned
   *     tdb1,tdb2 follow suit.
   *
   *  2) The 2006 IAU General Assembly introduced a conventional linear
   *     transformation between TDB and TCB.  This transformation
   *     compensates for the drift between TCB and terrestrial time TT,
   *     and keeps TDB approximately centered on TT.  Because the
   *     relationship between TT and TCB depends on the adopted solar
   *     system ephemeris, the degree of alignment between TDB and TT over
   *     long intervals will vary according to which ephemeris is used.
   *     Former definitions of TDB attempted to avoid this problem by
   *     stipulating that TDB and TT should differ only by periodic
   *     effects.  This is a good description of the nature of the
   *     relationship but eluded precise mathematical formulation.  The
   *     conventional linear relationship adopted in 2006 sidestepped
   *     these difficulties whilst delivering a TDB that in practice was
   *     consistent with values before that date.
   *
   *  3) TDB is essentially the same as Teph, the time argument for the
   *     JPL solar system ephemerides.
   *
   *  Reference:
   *
   *     IAU 2006 Resolution B3
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Tcbtdb($tcb1, $tcb2, &$tdb1, &$tdb2) {
    /* 1977 Jan 1 00:00:32.184 TT, as two-part JD */
    $t77td = DJM0 + DJM77;
    $t77tf = TTMTAI / DAYSEC;

    /* TDB (days) at TAI 1977 Jan 1.0 */
    $tdb0 = TDB0 / DAYSEC;

    $d;

    /* Result, safeguarding precision. */
    if ($tcb1 > $tcb2) {
      $d    = $tcb1 - $t77td;
      $tdb1 = $tcb1;
      $tdb2 = $tcb2 + $tdb0 - ( $d + ( $tcb2 - $t77tf ) ) * ELB;
    }
    else {
      $d    = $tcb2 - $t77td;
      $tdb1 = $tcb1 + $tdb0 - ( $d + ( $tcb1 - $t77tf ) ) * ELB;
      $tdb2 = $tcb2;
    }

    /* Status (always OK). */
    return 0;
  }

}
