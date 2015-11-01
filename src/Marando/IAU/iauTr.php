<?php

namespace Marando\IAU;

trait iauTr {

  /**
   *  - - - - - -
   *   i a u T r
   *  - - - - - -
   *
   *  Transpose an r-matrix.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     r        double[3][3]    r-matrix
   *
   *  Returned:
   *     rt       double[3][3]    transpose
   *
   *  Note:
   *     It is permissible for r and rt to be the same array.
   *
   *  Called:
   *     iauCr        copy r-matrix
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Tr(array $r, array &$rt) {
    $wm = [];
    $i;
    $j;

    for ($i = 0; $i < 3; $i++) {
      for ($j = 0; $j < 3; $j++) {
        $wm[$i][$j] = $r[$j][$i];
      }
    }
    IAU::Cr($wm, $rt);

    return;
  }

}
