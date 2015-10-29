<?php

namespace Marando\IAU;

trait iauC2s {

  /**
   *  - - - - - - -
   *   i a u C 2 s
   *  - - - - - - -
   *
   *  P-vector to spherical coordinates.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     p      double[3]    p-vector
   *
   *  Returned:
   *     theta  double       longitude angle (radians)
   *     phi    double       latitude angle (radians)
   *
   *  Notes:
   *
   *  1) The vector p can have any magnitude; only its direction is used.
   *
   *  2) If p is null, zero theta and phi are returned.
   *
   *  3) At either pole, zero theta is returned.
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function iauC2s(array $p, &$theta, &$phi) {
    $x;
    $y;
    $z;
    $d2;

    $x  = $p[0];
    $y  = $p[1];
    $z  = $p[2];
    $d2 = $x * $x + $y * $y;

    $theta = ($d2 == 0.0) ? 0.0 : atan2($y, $x);
    $phi   = ($z == 0.0) ? 0.0 : atan2($z, sqrt($d2));

    return;
  }

}
