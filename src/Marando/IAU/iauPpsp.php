<?php

namespace Marando\IAU;

trait iauPpsp {

  /**
   *  - - - - - - - -
   *   i a u P p s p
   *  - - - - - - - -
   *
   *  P-vector plus scaled p-vector.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     a      double[3]     first p-vector
   *     s      double        scalar (multiplier for b)
   *     b      double[3]     second p-vector
   *
   *  Returned:
   *     apsb   double[3]     a + s*b
   *
   *  Note:
   *     It is permissible for any of a, b and apsb to be the same array.
   *
   *  Called:
   *     iauSxp       multiply p-vector by scalar
   *     iauPpp       p-vector plus p-vector
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Ppsp(array $a, $s, array $b, array &$apsb) {
    $sb = [];

    /* s*b. */
    IAU::Sxp($s, $b, $sb);

    /* a + s*b. */
    IAU::Ppp($a, $sb, $apsb);

    return;
  }

}
