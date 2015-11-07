<?php

namespace Marando\IAU;

trait iauS2pv {

  /**
   *  - - - - - - - -
   *   i a u S 2 p v
   *  - - - - - - - -
   *
   *  Convert position/velocity from spherical to Cartesian coordinates.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     theta    double          longitude angle (radians)
   *     phi      double          latitude angle (radians)
   *     r        double          radial distance
   *     td       double          rate of change of theta
   *     pd       double          rate of change of phi
   *     rd       double          rate of change of r
   *
   *  Returned:
   *     pv       double[2][3]    pv-vector
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function S2pv($theta, $phi, $r, $td, $pd, $rd, array &$pv) {
    $st;
    $ct;
    $sp;
    $cp;
    $rcp;
    $x;
    $y;
    $rpd;
    $w;

    $st  = sin($theta);
    $ct  = cos($theta);
    $sp  = sin($phi);
    $cp  = cos($phi);
    $rcp = $r * $cp;
    $x   = $rcp * $ct;
    $y   = $rcp * $st;
    $rpd = $r * $pd;
    $w   = $rpd * $sp - $cp * $rd;

    $pv[0][0] = $x;
    $pv[0][1] = $y;
    $pv[0][2] = $r * $sp;
    $pv[1][0] = -$y * $td - $w * $ct;
    $pv[1][1] = $x * $td - $w * $st;
    $pv[1][2] = $rpd * $cp + $sp * $rd;

    return;
  }

}
