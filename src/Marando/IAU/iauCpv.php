<?php

namespace Marando\IAU;

trait iauCpv {

  /**
   *  - - - - - - -
   *   i a u C p v
   *  - - - - - - -
   *
   *  Copy a position/velocity vector.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Given:
   *     pv     double[2][3]    position/velocity vector to be copied
   *
   *  Returned:
   *     c      double[2][3]    copy
   *
   *  Called:
   *     iauCp        copy p-vector
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function iauCpv(array $pv, array &$c) {
    // Added in PHP porting... initialize $c array
    $c[] = [0, 0, 0];
    $c[] = [0, 0, 0];

    SOFA::iauCp($pv[0], $c[0]);
    SOFA::iauCp($pv[1], $c[1]);

    return;
  }

}
