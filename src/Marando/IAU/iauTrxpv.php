<?php

namespace Marando\IAU;

trait iauTrxpv {

  /**
   *  - - - - - - - - -
   *   i a u T r x p v
   *  - - - - - - - - -
   *
   *  Multiply a pv-vector by the transpose of an r-matrix.
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
   *     trpv     double[2][3]    r * pv
   *
   *  Note:
   *     It is permissible for pv and trpv to be the same array.
   *
   *  Called:
   *     iauTr        transpose r-matrix
   *     iauRxpv      product of r-matrix and pv-vector
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Trxpv(array $r, array $pv, array &$trpv) {
    $tr = [];

    /* Transpose of matrix r. */
    IAU::Tr($r, $tr);

    /* Matrix tr * vector pv -> vector trpv. */
    IAU::Rxpv($tr, $pv, $trpv);

    return;
  }

}
