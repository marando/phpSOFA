<?php

namespace Marando\IAU;

trait iauIr {

  /**
   *  - - - - - -
   *   i a u I r
   *  - - - - - -
   *
   *  Initialize an r-matrix to the identity matrix.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards Of Fundamental Astronomy) software collection.
   *
   *  Status:  vector/matrix support function.
   *
   *  Returned:
   *     r       double[3][3]    r-matrix
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Ir(array &$r) {
    $r[0][0] = 1.0;
    $r[0][1] = 0.0;
    $r[0][2] = 0.0;
    $r[1][0] = 0.0;
    $r[1][1] = 1.0;
    $r[1][2] = 0.0;
    $r[2][0] = 0.0;
    $r[2][1] = 0.0;
    $r[2][2] = 1.0;

    return;
  }

}
