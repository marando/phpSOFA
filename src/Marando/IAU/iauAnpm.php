<?php

namespace Marando\IAU;

trait iauAnpm {

  /**
   *  - - - - - - - -
   *   i a u A n p m
   *  - - - - - - - -
   *
   *  Normalize angle into the range -pi <= a < +pi.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     a        double     angle (radians)
   *
   *  Returned (function value):
   *              double     angle in range +/-pi
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Anpm($a) {
    $w;

    $w = fmod($a, D2PI);
    if (abs($w) >= DPI)
      $w -= sign(D2PI, $a);

    return $w;
  }

}
