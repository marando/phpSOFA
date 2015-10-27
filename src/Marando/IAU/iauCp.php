<?php

namespace Marando\IAU;

trait iauCp {

  /**
   *  - - - - - -
   *   i a u C p
   *  - - - - - -
   *
   *  Copy a p-vector.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     p        double[3]     p-vector to be copied
   *
   *  Returned:
   *     c        double[3]     copy
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function iauCp(array $p, array &$c) {
    $c[0] = $p[0];
    $c[1] = $p[1];
    $c[2] = $p[2];

    return;
  }

}
