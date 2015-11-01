<?php

namespace Marando\IAU;

trait iauRxpv {

  /**
   *  - - - - - - - -
   *   i a u R x p v
   *  - - - - - - - -
   *
   *  Multiply a pv-vector by an r-matrix.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     r        double[3][3]    r-matrix
   *     pv       double[2][3]    pv-vector
   *
   *  Returned:
   *     rpv      double[2][3]    r * pv
   *
   *  Note:
   *     It is permissible for pv and rpv to be the same array.
   *
   *  Called:
   *     iauRxp       product of r-matrix and p-vector
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Rxpv(array $r, array $pv, array &$rpv) {
    IAU::Rxp($r, $pv[0], $rpv[0]);
    IAU::Rxp($r, $pv[1], $rpv[1]);

    return;
  }

}
