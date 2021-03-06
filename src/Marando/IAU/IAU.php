<?php

namespace Marando\IAU;

class IAU {

  use iauA2af,
      iauA2tf,
      iauAb,
      iauAf2a,
      iauAnp,
      iauAnpm,
      iauApcg,
      iauApci,
      iauApci13,
      iauApcs,
      iauAper,
      iauAtciq,
      iauBi00,
      iauBp00,
      iauBpn2xy,
      iauC2ixys,
      iauC2s,
      iauCp,
      iauCpv,
      iauCr,
      iauD2tf,
      iauDtdb,
      iauEe00,
      iauEe00a,
      iauEect00,
      iauEors,
      iauEpj,
      iauEpj2jd,
      iauEpv00,
      iauEra00,
      iauFad03,
      iauFae03,
      iauFaf03,
      iauFaju03,
      iauFal03,
      iauFalp03,
      iauFama03,
      iauFame03,
      iauFaom03,
      iauFapa03,
      iauFasa03,
      iauFaur03,
      iauFave03,
      iauFw2m,
      iauGmst00,
      iauGmst06,
      iauGmst82,
      iauGst00a,
      iauIr,
      iauLd,
      iauLdsun,
      iauNut00a,
      iauNut00b,
      iauNut06a,
      iauNut80,
      iauObl06,
      iauObl80,
      iauPdp,
      iauPfw06,
      iauPm,
      iauPmpx,
      iauPn,
      iauPnm06a,
      iauPr00,
      iauPxp,
      iauRefco,
      iauRx,
      iauRxp,
      iauRxr,
      iauRy,
      iauRz,
      iauS06,
      iauS2c,
      iauSxp,
      iauTdbtt,
      iauZp,
      iauJd2cal,
      iauCal2jd,
      iauTaitt,
      iauDat,
      iauUtctai,
      iauUtcut1,
      iauTaiut1,
      iauSp00,
      iauEform,
      iauGd2gce,
      iauGd2gc,
      iauPom00,
      iauTr,
      iauTrxp,
      iauPvtob,
      iauTrxpv,
      iauRxpv,
      iauApco,
      iauApco13,
      iauAtioq,
      iauApio,
      iauApio13,
      iauAtco13,
      iauApcg13,
      iauApcs13,
      iauAper13,
      iauAtci13,
      iauPmp,
      iauPpp,
      iauPpsp,
      iauLdn,
      iauAtciqn,
      iauAtciqz,
      iauAtic13,
      iauAticq,
      iauAticqn,
      iauS2p,
      iauS2pv,
      iauAtoiq,
      iauAtoc13,
      iauAtio13,
      iauTttai,
      iauTttcg,
      iauTttdb,
      iauTtut1,
      iauUt1tai,
      iauUt1tt,
      iauUt1utc,
  ///////
      iauTaiutc,
      iauTcbtdb,
      iauTcgtt,
      iauTdbtcb,
      iauD2dtf,
      iauDtf2d,
      iauEpb2jd,
      iauEe00b,
      iauGst00b,
      iauGst06,
      iauGst06a,
      iauTf2a,
      iauTf2d;
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
