<?php

namespace Marando\IAU;

trait iauTrxp {

  /**
   *  - - - - - - - -
   *   i a u T r x p
   *  - - - - - - - -
   *
   *  Multiply a p-vector by the transpose of an r-matrix.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     r        double[3][3]   r-matrix
   *     p        double[3]      p-vector
   *
   *  Returned:
   *     trp      double[3]      r * p
   *
   *  Note:
   *     It is permissible for p and trp to be the same array.
   *
   *  Called:
   *     iauTr        transpose r-matrix
   *     iauRxp       product of r-matrix and p-vector
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Trxp(array $r, array $p, array &$trp) {
    $tr = [];

    /* Transpose of matrix r. */
    IAU::Tr($r, $tr);

    /* Matrix tr * vector p -> vector trp. */
    IAU::Rxp($tr, $p, $trp);

    return;
  }

}
