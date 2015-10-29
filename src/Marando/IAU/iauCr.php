<?php

namespace Marando\IAU;

trait iauCr {

  public static function iauCr(array $r, array &$c) {
    // Added in PHP porting... initialize $c array
    $c[] = [0, 0, 0];
    $c[] = [0, 0, 0];
    $c[] = [0, 0, 0];

    SOFA::iauCp($r[0], $c[0]);
    SOFA::iauCp($r[1], $c[1]);
    SOFA::iauCp($r[2], $c[2]);

    return;
  }

}
