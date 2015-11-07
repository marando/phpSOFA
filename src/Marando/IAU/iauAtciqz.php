<?php

namespace Marando\IAU;

trait iauAtciqz {

  /**
   *  - - - - - - - - - -
   *   i a u A t c i q z
   *  - - - - - - - - - -
   *
   *  Quick ICRS to CIRS transformation, given precomputed star-
   *  independent astrometry parameters, and assuming zero parallax and
   *  proper motion.
   *
   *  Use of this function is appropriate when efficiency is important and
   *  where many star positions are to be transformed for one date.  The
   *  star-independent parameters can be obtained by calling one of the
   *  functions iauApci[13], iauApcg[13], iauApco[13] or iauApcs[13].
   *
   *  The corresponding function for the case of non-zero parallax and
   *  proper motion is iauAtciq.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     rc,dc  double     ICRS astrometric RA,Dec (radians)
   *     astrom iauASTROM* star-independent astrometry parameters:
   *      pmt    double       PM time interval (SSB, Julian years)
   *      eb     double[3]    SSB to observer (vector, au)
   *      eh     double[3]    Sun to observer (unit vector)
   *      em     double       distance from Sun to observer (au)
   *      v      double[3]    barycentric observer velocity (vector, c)
   *      bm1    double       sqrt(1-|v|^2): reciprocal of Lorenz factor
   *      bpn    double[3][3] bias-precession-nutation matrix
   *      along  double       longitude + s' (radians)
   *      xpl    double       polar motion xp wrt local meridian (radians)
   *      ypl    double       polar motion yp wrt local meridian (radians)
   *      sphi   double       sine of geodetic latitude
   *      cphi   double       cosine of geodetic latitude
   *      diurab double       magnitude of diurnal aberration vector
   *      eral   double       "local" Earth rotation angle (radians)
   *      refa   double       refraction constant A (radians)
   *      refb   double       refraction constant B (radians)
   *
   *  Returned:
   *     ri,di  double     CIRS RA,Dec (radians)
   *
   *  Note:
   *
   *     All the vectors are with respect to BCRS axes.
   *
   *  References:
   *
   *     Urban, S. & Seidelmann, P. K. (eds), Explanatory Supplement to
   *     the Astronomical Almanac, 3rd ed., University Science Books
   *     (2013).
   *
   *     Klioner, Sergei A., "A practical relativistic model for micro-
   *     arcsecond astrometry in space", Astr. J. 125, 1580-1597 (2003).
   *
   *  Called:
   *     iauS2c       spherical coordinates to unit vector
   *     iauLdsun     light deflection due to Sun
   *     iauAb        stellar aberration
   *     iauRxp       product of r-matrix and p-vector
   *     iauC2s       p-vector to spherical
   *     iauAnp       normalize angle into range +/- pi
   *
   *  This revision:   2013 October 9
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Atciqz($rc, $dc, iauASTROM &$astrom, &$ri, &$di) {
    $pco  = [];
    $pnat = [];
    $ppr  = [];
    $pi   = [];
    $w;

    /* BCRS coordinate direction (unit vector). */
    IAU::S2c($rc, $dc, $pco);

    /* Light deflection by the Sun, giving BCRS natural direction. */
    IAU::Ldsun($pco, $astrom->eh, $astrom->em, $pnat);

    /* Aberration, giving GCRS proper direction. */
    IAU::Ab($pnat, $astrom->v, $astrom->em, $astrom->bm1, $ppr);

    /* Bias-precession-nutation, giving CIRS proper direction. */
    IAU::Rxp($astrom->bpn, $ppr, $pi);

    /* CIRS RA,Dec. */
    IAU::C2s($pi, $w, $di);
    $ri = IAU::Anp($w);

    /* Finished. */
  }

}
