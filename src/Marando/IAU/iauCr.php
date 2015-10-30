<?php

namespace Marando\IAU;

trait iauCr {

  public static function Cr(array $r, array &$c) {
    // Added in PHP porting... initialize $c array
    $c[] = [0, 0, 0];
    $c[] = [0, 0, 0];
    $c[] = [0, 0, 0];

    IAU::Cp($r[0], $c[0]);
    IAU::Cp($r[1], $c[1]);
    IAU::Cp($r[2], $c[2]);

    return;
  }

}
