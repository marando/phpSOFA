<?php

namespace Marando\IAU;

trait iauPdp {

  /**
   *  - - - - - - -
   *   i a u P d p
   *  - - - - - - -
   *
   *  p-vector inner (=scalar=dot) product.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     a      double[3]     first p-vector
   *     b      double[3]     second p-vector
   *
   *  Returned (function value):
   *            double        a . b
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Pdp(array $a, array $b) {
    $w;

    $w = 0 +
            $a[0] * $b[0] +
            $a[1] * $b[1] +
            $a[2] * $b[2];

    return $w;
  }

}
