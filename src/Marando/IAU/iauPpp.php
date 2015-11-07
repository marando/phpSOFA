<?php

namespace Marando\IAU;

trait iauPpp {

  public static function Ppp(array $a, array $b, array &$apb) {
    $apb[0] = $a[0] + $b[0];
    $apb[1] = $a[1] + $b[1];
    $apb[2] = $a[2] + $b[2];

    return;
  }

}
