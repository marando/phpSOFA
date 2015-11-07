<?php

namespace Marando\IAU;

trait iauPmp {

  /**
   *  - - - - - - -
   *   i a u P m p
   *  - - - - - - -
   *
   *  P-vector subtraction.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     a        double[3]      first p-vector
   *     b        double[3]      second p-vector
   *
   *  Returned:
   *     amb      double[3]      a - b
   *
   *  Note:
   *     It is permissible to re-use the same array for any of the
   *     arguments.
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Pmp(array $a, array $b, array &$amb) {
    $amb[0] = $a[0] - $b[0];
    $amb[1] = $a[1] - $b[1];
    $amb[2] = $a[2] - $b[2];

    return;
  }

}
