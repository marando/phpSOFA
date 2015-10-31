<?php

namespace Marando\IAU;

trait iauEors {

  /**
   *  - - - - - - - -
   *   i a u E o r s
   *  - - - - - - - -
   *
   *  Equation of the origins, given the classical NPB matrix and the
   *  quantity s.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     rnpb  double[3][3]  classical nutation x precession x bias matrix
   *     s     double        the quantity s (the CIO locator)
   *
   *  Returned (function value):
   *           double        the equation of the origins in radians.
   *
   *  Notes:
   *
   *  1)  The equation of the origins is the distance between the true
   *      equinox and the celestial intermediate origin and, equivalently,
   *      the difference between Earth rotation angle and Greenwich
   *      apparent sidereal time (ERA-GST).  It comprises the precession
   *      (since J2000.0) in right ascension plus the equation of the
   *      equinoxes (including the small correction terms).
   *
   *  2)  The algorithm is from Wallace & Capitaine (2006).
   *
   * References:
   *
   *     Capitaine, N. & Wallace, P.T., 2006, Astron.Astrophys. 450, 855
   *
   *     Wallace, P. & Capitaine, N., 2006, Astron.Astrophys. 459, 981
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Eors(array $rnpb, $s) {
    $x;
    $ax;
    $xs;
    $ys;
    $zs;
    $p;
    $q;
    $eo;

    /* Evaluate Wallace & Capitaine (2006) expression (16). */
    $x  = $rnpb[2][0];
    $ax = $x / (1.0 + $rnpb[2][2]);
    $xs = 1.0 - $ax * $x;
    $ys = -$ax * $rnpb[2][1];
    $zs = -$x;
    $p  = $rnpb[0][0] * $xs + $rnpb[0][1] * $ys + $rnpb[0][2] * $zs;
    $q  = $rnpb[1][0] * $xs + $rnpb[1][1] * $ys + $rnpb[1][2] * $zs;
    $eo = (($p != 0) || ($q != 0)) ? $s - atan2($q, $p) : $s;

    return $eo;
  }

}
