<?php

namespace Marando\IAU;

trait iauAtioq {

  /**
   *  - - - - - - - - -
   *   i a u A t i o q
   *  - - - - - - - - -
   *
   *  Quick CIRS to observed place transformation.
   *
   *  Use of this function is appropriate when efficiency is important and
   *  where many star positions are all to be transformed for one date.
   *  The star-independent astrometry parameters can be obtained by
   *  calling iauApio[13] or iauApco[13].
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     ri     double     CIRS right ascension
   *     di     double     CIRS declination
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
   *     aob    double*    observed azimuth (radians: N=0,E=90)
   *     zob    double*    observed zenith distance (radians)
   *     hob    double*    observed hour angle (radians)
   *     dob    double*    observed declination (radians)
   *     rob    double*    observed right ascension (CIO-based, radians)
   *
   *  Notes:
   *
   *  1) This function returns zenith distance rather than altitude in
   *     order to reflect the fact that no allowance is made for
   *     depression of the horizon.
   *
   *  2) The accuracy of the result is limited by the corrections for
   *     refraction, which use a simple A*tan(z) + B*tan^3(z) model.
   *     Providing the meteorological parameters are known accurately and
   *     there are no gross local effects, the predicted observed
   *     coordinates should be within 0.05 arcsec (optical) or 1 arcsec
   *     (radio) for a zenith distance of less than 70 degrees, better
   *     than 30 arcsec (optical or radio) at 85 degrees and better
   *     than 20 arcmin (optical) or 30 arcmin (radio) at the horizon.
   *
   *     Without refraction, the complementary functions iauAtioq and
   *     iauAtoiq are self-consistent to better than 1 microarcsecond all
   *     over the celestial sphere.  With refraction included, consistency
   *     falls off at high zenith distances, but is still better than
   *     0.05 arcsec at 85 degrees.
   *
   *  3) It is advisable to take great care with units, as even unlikely
   *     values of the input parameters are accepted and processed in
   *     accordance with the models used.
   *
   *  4) The CIRS RA,Dec is obtained from a star catalog mean place by
   *     allowing for space motion, parallax, the Sun's gravitational lens
   *     effect, annual aberration and precession-nutation.  For star
   *     positions in the ICRS, these effects can be applied by means of
   *     the iauAtci13 (etc.) functions.  Starting from classical "mean
   *     place" systems, additional transformations will be needed first.
   *
   *  5) "Observed" Az,El means the position that would be seen by a
   *     perfect geodetically aligned theodolite.  This is obtained from
   *     the CIRS RA,Dec by allowing for Earth orientation and diurnal
   *     aberration, rotating from equator to horizon coordinates, and
   *     then adjusting for refraction.  The HA,Dec is obtained by
   *     rotating back into equatorial coordinates, and is the position
   *     that would be seen by a perfect equatorial with its polar axis
   *     aligned to the Earth's axis of rotation.  Finally, the RA is
   *     obtained by subtracting the HA from the local ERA.
   *
   *  6) The star-independent CIRS-to-observed-place parameters in ASTROM
   *     may be computed with iauApio[13] or iauApco[13].  If nothing has
   *     changed significantly except the time, iauAper[13] may be used to
   *     perform the requisite adjustment to the astrom structure.
   *
   *  Called:
   *     iauS2c       spherical coordinates to unit vector
   *     iauC2s       p-vector to spherical
   *     iauAnp       normalize angle into range 0 to 2pi
   *
   *  This revision:   2013 December 5
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Atioq($ri, $di, iauASTROM $astrom, &$aob, &$zob, &$hob,
          &$dob, &$rob) {

    /* Minimum cos(alt) and sin(alt) for refraction purposes */
    $CELMIN = 1e-6;
    $SELMIN = 0.05;

    $v = [];
    $x;
    $y;
    $z;
    $xhd;
    $yhd;
    $zhd;
    $f;
    $xhdt;
    $yhdt;
    $zhdt;
    $xaet;
    $yaet;
    $zaet;
    $azobs;
    $r;
    $tz;
    $w;
    $del;
    $cosdel;
    $xaeo;
    $yaeo;
    $zaeo;
    $zdobs;
    $hmobs;
    $dcobs;
    $raobs;

    /* -------------------------------------------------------------------- */

    /* CIRS RA,Dec to Cartesian -HA,Dec. */
    IAU::S2c($ri - $astrom->eral, $di, $v);
    $x = $v[0];
    $y = $v[1];
    $z = $v[2];

    /* Polar motion. */
    $xhd = $x + $astrom->xpl * $z;
    $yhd = $y - $astrom->ypl * $z;
    $zhd = $z - $astrom->xpl * $x + $astrom->ypl * $y;

    /* Diurnal aberration. */
    $f    = ( 1.0 - $astrom->diurab * $yhd );
    $xhdt = $f * $xhd;
    $yhdt = $f * ( $yhd + $astrom->diurab );
    $zhdt = $f * $zhd;

    /* Cartesian -HA,Dec to Cartesian Az,El (S=0,E=90). */
    $xaet = $astrom->sphi * $xhdt - $astrom->cphi * $zhdt;
    $yaet = $yhdt;
    $zaet = $astrom->cphi * $xhdt + $astrom->sphi * $zhdt;

    /* Azimuth (N=0,E=90). */
    $azobs = ( $xaet != 0.0 || $yaet != 0.0 ) ? atan2($yaet, -$xaet) : 0.0;

    /* ---------- */
    /* Refraction */
    /* ---------- */

    /* Cosine and sine of altitude, with precautions. */
    $r = sqrt($xaet * $xaet + $yaet * $yaet);
    $r = $r > $CELMIN ? $r : $CELMIN;
    $z = $zaet > $SELMIN ? $zaet : $SELMIN;

    /* A*tan(z)+B*tan^3(z) model, with Newton-Raphson correction. */
    $tz  = $r / $z;
    $w   = $astrom->refb * $tz * $tz;
    $del = ( $astrom->refa + $w ) * $tz /
            ( 1.0 + ( $astrom->refa + 3.0 * $w ) / ( $z * $z ) );

    /* Apply the change, giving observed vector. */
    $cosdel = 1.0 - $del * $del / 2.0;
    $f      = $cosdel - $del * $z / $r;
    $xaeo   = $xaet * $f;
    $yaeo   = $yaet * $f;
    $zaeo   = $cosdel * $zaet + $del * $r;

    /* Observed ZD. */
    $zdobs = atan2(sqrt($xaeo * $xaeo + $yaeo * $yaeo), $zaeo);

    /* Az/El vector to HA,Dec vector (both right-handed). */
    $v[0] = $astrom->sphi * $xaeo + $astrom->cphi * $zaeo;
    $v[1] = $yaeo;
    $v[2] = -$astrom->cphi * $xaeo + $astrom->sphi * $zaeo;

    /* To spherical -HA,Dec. */
    IAU::C2s($v, $hmobs, $dcobs);

    /* Right ascension (with respect to CIO). */
    $raobs = $astrom->eral + $hmobs;

    /* Return the results. */
    $aob = IAU::Anp($azobs);
    $zob = $zdobs;
    $hob = -$hmobs;
    $dob = $dcobs;
    $rob = IAU::Anp($raobs);

    /* Finished. */
  }

}
