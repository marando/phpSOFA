<?php

namespace Marando\IAU;

trait iauPn {

  /**
   *  - - - - - -
   *   i a u P n
   *  - - - - - -
   *
   *  Convert a p-vector into modulus and unit vector.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     p        double[3]      p-vector
   *
   *  Returned:
   *     r        double         modulus
   *     u        double[3]      unit vector
   *
   *  Notes:
   *
   *  1) If p is null, the result is null.  Otherwise the result is a unit
   *     vector.
   *
   *  2) It is permissible to re-use the same array for any of the
   *     arguments.
   *
   *  Called:
   *     iauPm        modulus of p-vector
   *     iauZp        zero p-vector
   *     iauSxp       multiply p-vector by scalar
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Pn(array $p, &$r, array &$u) {
    $w;

    /* Obtain the modulus and test for zero. */
    $w = static::Pm($p);
    if ($w == 0.0) {

      /* Null vector. */
      static::Zp($u);
    }
    else {

      /* Unit vector. */
      static::Sxp(1.0 / $w, $p, $u);
    }

    /* Return the modulus. */
    $r = $w;

    return;
  }

}
