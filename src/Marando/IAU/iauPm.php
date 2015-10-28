<?php

namespace Marando\IAU;

trait iauPm {

  /**
   *  - - - - - -
   *   i a u P m
   *  - - - - - -
   *
   *  Modulus of p-vector.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     p      double[3]     p-vector
   *
   *  Returned (function value):
   *            double        modulus
   *
   *  This revision:  2013 August 7
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function iauPm(array $p) {
    return sqrt($p[0] * $p[0] + $p[1] * $p[1] + $p[2] * $p[2]);
  }

}
