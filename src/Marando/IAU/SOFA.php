<?php

namespace Marando\IAU;

class SOFA {
  //----------------------------------------------------------------------------
  // Constants
  //----------------------------------------------------------------------------

  /**
   * 2π
   */
  const D2PI = 6.283185307179586476925287;

  /**
   * π
   */
  const DPI = 3.141592653589793238462643;

  /**
   * Arcseconds to radians
   */
  const DAS2R = 4.848136811095359935899141e-6;

  /**
   * Days to seconds
   */
  const DAYSEC = 86400;

  /**
   * Schwarzschild radius of the Sun (au)
   * = 2 * 1.32712440041e20 / (2.99792458e8)^2 / 1.49597870700e11
   */
  const SRS = 1.97412574336e-08;

  //----------------------------------------------------------------------------
  // Traits - To avoid a large file each SOFA routine is included as a trait
  //----------------------------------------------------------------------------

  use iauA2af,
      iauA2tf,
      iauAb,
      iauAf2a,
      iauAnp,
      iauAnpm,
      iauCp,
      iauPm,
      iauD2tf,
      iauPdp,
      iauZp,
      iauSxp,
      iauPn;
}

/**
 * Returns A with the sign of B
 * @param type $a
 * @param type $b
 * @return type
 */
function sign($a, $b) {
  if ($b > 0)
    return $a > 0 ? $a : -$a;
  else
    return $a < 0 ? $a : -$a;
}
