<?php

namespace Marando\IAU;

trait iauSxp {

  /**
   *  - - - - - - -
   *   i a u S x p
   *  - - - - - - -
   *
   *  Multiply a p-vector by a scalar.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     s      double        scalar
   *     p      double[3]     p-vector
   *
   *  Returned:
   *     sp     double[3]     s * p
   *
   *  Note:
   *     It is permissible for p and sp to be the same array.
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Sxp($s, array $p, array &$sp) {
    $sp[0] = $s * $p[0];
    $sp[1] = $s * $p[1];
    $sp[2] = $s * $p[2];

    return;
  }

}
