<?php

namespace Marando\IAU;

class SOFA {

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
      iauEra00,
      iauGmst06,
      iauGmst82,
      iauGst00a,
      iauEe00a,
      iauPr00,
      iauEe00,
      iauEect00,
      iauFalp03,
      iauFad03,
      iauRefco,
      iauC2s,
      iauS2c,
      iauCpv,
      iauApcg,
      iauBi00,
      iauRx,
      iauRy,
      iauRz,
      iauCr,
      iauBp00,
      iauRxr;
}

//------------------------------------------------------------------------------
// IAU CONSTANTS
//------------------------------------------------------------------------------

/** Pi */
const DPI = 3.141592653589793238462643;

/** 2Pi */
const D2PI = 6.283185307179586476925287;

/** Radians to degrees */
const DR2D = 57.29577951308232087679815;

/** Degrees to radians */
const DD2R = 1.745329251994329576923691e-2;

/** Radians to arcseconds */
const DR2AS = 206264.8062470963551564734;

/** Arcseconds to radians */
const DAS2R = 4.848136811095359935899141e-6;

/** Seconds of time to radians */
const DS2R = 7.272205216643039903848712e-5;

/** Arcseconds in a full circle */
const TURNAS = 1296000.0;

/** Milliarcseconds to radians */
const DMAS2R = DAS2R / 1e3;

/** Length of tropical year B1900 (days) */
const DTY = 365.242198781;

/** Seconds per day. */
const DAYSEC = 86400.0;

/** Days per Julian year */
const DJY = 365.25;

/** Days per Julian century */
const DJC = 36525.0;

/** Days per Julian millennium */
const DJM = 365250.0;

/** Reference epoch (J2000.0), Julian Date */
const DJ00 = 2451545.0;

/** Julian Date of Modified Julian Date zero */
const DJM0 = 2400000.5;

/** Reference epoch (J2000.0), Modified Julian Date */
const DJM00 = 51544.5;

/** 1977 Jan 1.0 as MJD */
const DJM77 = 43144.0;

/** TT minus TAI (s) */
const TTMTAI = 32.184;

/** Astronomical unit (m) */
const DAU = 149597870e3;

/** Speed of light (m/s) */
const CMPS = 299792458.0;

/** Light time for 1 au (s) */
const AULT = 499.004782;

/** Speed of light (AU per day) */
const DC = DAYSEC / AULT;

/** L_G = 1 - d(TT)/d(TCG) */
const ELG = 6.969290134e-10;

/** L_B = 1 - d(TDB)/d(TCB), and TDB (s) at TAI 1977/1/1.0 */
const ELB = 1.550519768e-8;

/** L_B = 1 - d(TDB)/d(TCB), and TDB (s) at TAI 1977/1/1.0 */
const TDB0 = -6.55e-5;

/** Schwarzschild radius of the Sun (au)
 *  = 2 * 1.32712440041e20 / (2.99792458e8)^2 / 1.49597870700e11 */
const SRS = 1.97412574336e-8;

/** Reference ellipsoid */
const WGS84 = 1;

/** Reference ellipsoid */
const GRS80 = 2;

/** Reference ellipsoid */
const WGS72 = 3;

//------------------------------------------------------------------------------
// GLOBAL FUNCTIONS
//------------------------------------------------------------------------------

/**
 * Magnitude of A with sign of B (double)
 * @param  float $A
 * @param  float $B
 * @return float
 */
function sign($A, $B) {
  return $B < 0.0 ? -abs($A) : abs($A);
}
