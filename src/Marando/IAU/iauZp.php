<?php

namespace Marando\IAU;

trait iauZp {

  /**
   *  - - - - - -
   *   i a u Z p
   *  - - - - - -
   *
   *  Zero a p-vector.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Returned:
   *     p        double[3]      p-vector
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function iauZp(array &$p) {
    $p[0] = 0.0;
    $p[1] = 0.0;
    $p[2] = 0.0;

    return;
  }

}
