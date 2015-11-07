<?php

namespace Marando\IAU;

/**
 * Body parameters for light deflection
 */
class iauLDBODY {

  /**
   * mass of the body (solar masses)
   * @var float
   */
  public $bm;

  /**
   * deflection limiter (radians^2/2)
   * @var float
   */
  public $dl;

  /**
   * barycentric PV of the body (au, au/day)
   * @var array[2,3]
   */
  public $pv;

}
