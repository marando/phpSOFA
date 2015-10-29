<?php

namespace Marando\IAU;

trait iauS2c {

  /**
   *  - - - - - - -
   *   i a u S 2 c
   *  - - - - - - -
   *
   *  Convert spherical coordinates to Cartesian.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     theta    double       longitude angle (radians)
   *     phi      double       latitude angle (radians)
   *
   *  Returned:
   *     c        double[3]    direction cosines
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function iauS2c($theta, $phi, array &$c) {
    $cp;

    $cp   = cos($phi);
    $c[0] = cos($theta) * $cp;
    $c[1] = sin($theta) * $cp;
    $c[2] = sin($phi);

    return;
  }

}
