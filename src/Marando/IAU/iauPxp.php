<?php

namespace Marando\IAU;

/**
 *  - - - - - - -
 *   i a u P x p
 *  - - - - - - -
 *
 *  p-vector outer (=vector=cross) product.
 *
 *  This function is part of the International Astronomical Union's
 *  SOFA (Standards Of Fundamental Astronomy) software collection.
 *
 *  Status:  vector/matrix support function.
 *
 *  Given:
 *     a        double[3]      first p-vector
 *     b        double[3]      second p-vector
 *
 *  Returned:
 *     axb      double[3]      a x b
 *
 *  Note:
 *     It is permissible to re-use the same array for any of the
 *     arguments.
 *
 *  This revision:  2013 June 18
 *
 *  SOFA release 2015-02-09
 *
 *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
 */
trait iauPxp {

  public static function Pxp(array $a, array $b, array &$axb) {
    $xa;
    $ya;
    $za;
    $xb;
    $yb;
    $zb;

    $xa     = $a[0];
    $ya     = $a[1];
    $za     = $a[2];
    $xb     = $b[0];
    $yb     = $b[1];
    $zb     = $b[2];
    $axb[0] = $ya * $zb - $za * $yb;
    $axb[1] = $za * $xb - $xa * $zb;
    $axb[2] = $xa * $yb - $ya * $xb;

    return;
  }

}
