<?php

namespace Marando\IAU;

class SOFA {
  //----------------------------------------------------------------------------
  // Constants
  //----------------------------------------------------------------------------

  /**
   *  Light time for 1 au (s)
   */
  const AULT = 499.004782;

  /**
   * 2π
   */
  const D2PI = 6.283185307179586476925287;

  /**
   * Astronomical unit (m)
   */
  const DAU = 149597870e3;

  /**
   * Degrees to radians
   */
  const DD2R = 1.745329251994329576923691e-2;

  /**
   * Reference epoch (J2000.0), JD
   */
  const DJ00 = 2451545;

  /**
   * Days per Julian century
   */
  const DJC = 36525;

  /**
   * Days per Julian millennium
   */
  const DJM = 365250;

  /**
   *  Days per Julian year
   */
  const DJY = 365.25;

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

  /**
   * Julian Date of Modified Julian Date zero
   */
  const DJM0 = 2400000.5;

  /**
   * Reference epoch (J2000.0), Modified Julian Date
   */
  const DJM00 = 51544.5;

  /**
   * Arcseconds in a full circle
   */
  const TURNAS = 1296000.0;

  /**
   * Milliarcseconds to radians
   */
  const DMAS2R = 4.848136811095359935899141e-9;

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
      iauPn,
      iauAper,
      iauIr,
      iauApcs,
      iauObl06,
      iauObl80,
      iauTdbtt,
      iauDtdb,
      iauEpj,
      iauEpj2jd,
      iauFal03,
      iauFaf03,
      iauFaom03,
      iauFame03,
      iauFave03,
      iauFae03,
      iauFama03,
      iauFaju03,
      iauFasa03,
      iauFaur03,
      iauFapa03,
      iauNut00a,
      iauNut06a,
      iauNut00b,
      iauNut80,
      iauGmst00,
      iauEra00;
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
