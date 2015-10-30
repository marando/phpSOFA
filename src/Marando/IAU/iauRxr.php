<?php

namespace Marando\IAU;

trait iauRxr {

  /**
   *  - - - - - - -
   *   i a u R x r
   *  - - - - - - -
   *
   *  Multiply two r-matrices.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     a        double[3][3]    first r-matrix
   *     b        double[3][3]    second r-matrix
   *
   *  Returned:
   *     atb      double[3][3]    a * b
   *
   *  Note:
   *     It is permissible to re-use the same array for any of the
   *     arguments.
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
  public static function Rxr(array $a, array $b, array &$atb) {
    $i;
    $j;
    $k;
    $w;
    $wm = [];

    for ($i = 0; $i < 3; $i++) {
      for ($j = 0; $j < 3; $j++) {
        $w = 0.0;
        for ($k = 0; $k < 3; $k++) {
          $w += $a[$i][$k] * $b[$k][$j];
        }
        $wm[$i][$j] = $w;
      }
    }
    IAU::Cr($wm, $atb);

    return;
  }

}
