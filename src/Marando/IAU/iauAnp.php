<?php

namespace Marando\IAU;

trait iauAnp {

  /**
   *  - - - - - - -
   *   i a u A n p
   *  - - - - - - -
   *
   *  Normalize angle into the range 0 <= a < 2pi.
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
   *              double     angle in range 0-2pi
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Anp($a) {
    $w;

    $w = fmod($a, D2PI);
    if ($w < 0)
      $w += D2PI;

    return $w;
  }

}
