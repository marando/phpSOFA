<?php

namespace Marando\IAU;

trait iauRxp {

  /**
   *  - - - - - - -
   *   i a u R x p
   *  - - - - - - -
   *
   *  Multiply a p-vector by an r-matrix.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     r        double[3][3]    r-matrix
   *     p        double[3]       p-vector
   *
   *  Returned:
   *     rp       double[3]       r * p
   *
   *  Note:
   *     It is permissible for p and rp to be the same array.
   *
   *  Called:
   *     iauCp        copy p-vector
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Rxp(array $r, array $p, array &$rp) {
    $w;
    $wrp = [];
    $i;
    $j;

    /* Matrix r * vector p. */
    for ($j = 0; $j < 3; $j++) {
      $w = 0.0;
      for ($i = 0; $i < 3; $i++) {
        $w += $r[$j][$i] * $p[$i];
      }
      $wrp[$j] = $w;
    }

    /* Return the result. */
    IAU::Cp($wrp, $rp);

    return;
  }

}
