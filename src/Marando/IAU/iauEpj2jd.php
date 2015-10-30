<?php

namespace Marando\IAU;

trait iauEpj2jd {

  /**
   *  - - - - - - - - - -
   *   i a u E p j 2 j d
   *  - - - - - - - - - -
   *
   *  Julian Epoch to Julian Date.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     epj      double    Julian Epoch (e.g. 1996.8)
   *
   *  Returned:
   *     djm0     double    MJD zero-point: always 2400000.5
   *     djm      double    Modified Julian Date
   *
   *  Note:
   *
   *     The Julian Date is returned in two pieces, in the usual SOFA
   *     manner, which is designed to preserve time resolution.  The
   *     Julian Date is available as a single number by adding djm0 and
   *     djm.
   *
   *  Reference:
   *
   *     Lieske, J.H., 1979, Astron.Astrophys. 73, 282.
   *
   *  This revision:  2013 August 7
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Epj2jd($epj, &$djm0, &$djm) {
    $djm0 = DJM0;
    $djm  = DJM00 + ($epj - 2000.0) * 365.25;

    return;
  }

}
