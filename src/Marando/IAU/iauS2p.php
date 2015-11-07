<?php

namespace Marando\IAU;

trait iauS2p {

  /**
   *  - - - - - - -
   *   i a u S 2 p
   *  - - - - - - -
   *
   *  Convert spherical polar coordinates to p-vector.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     theta   double       longitude angle (radians)
   *     phi     double       latitude angle (radians)
   *     r       double       radial distance
   *
   *  Returned:
   *     p       double[3]    Cartesian coordinates
   *
   *  Called:
   *     iauS2c       spherical coordinates to unit vector
   *     iauSxp       multiply p-vector by scalar
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function S2p($theta, $phi, $r, array &$p) {
    $u = [0, 0, 0];

    IAU::S2c($theta, $phi, $u);
    IAU::Sxp($r, $u, $p);

    return;
  }

}
