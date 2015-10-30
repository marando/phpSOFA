<?php

namespace Marando\IAU;

trait iauPmpx {

  /**
   *  - - - - - - - -
   *   i a u P m p x
   *  - - - - - - - -
   *
   *  Proper motion and parallax.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     rc,dc  double     ICRS RA,Dec at catalog epoch (radians)
   *     pr     double     RA proper motion (radians/year; Note 1)
   *     pd     double     Dec proper motion (radians/year)
   *     px     double     parallax (arcsec)
   *     rv     double     radial velocity (km/s, +ve if receding)
   *     pmt    double     proper motion time interval (SSB, Julian years)
   *     pob    double[3]  SSB to observer vector (au)
   *
   *  Returned:
   *     pco    double[3]  coordinate direction (BCRS unit vector)
   *
   *  Notes:
   *
   *  1) The proper motion in RA is dRA/dt rather than cos(Dec)*dRA/dt.
   *
   *  2) The proper motion time interval is for when the starlight
   *     reaches the solar system barycenter.
   *
   *  3) To avoid the need for iteration, the Roemer effect (i.e. the
   *     small annual modulation of the proper motion coming from the
   *     changing light time) is applied approximately, using the
   *     direction of the star at the catalog epoch.
   *
   *  References:
   *
   *     1984 Astronomical Almanac, pp B39-B41.
   *
   *     Urban, S. & Seidelmann, P. K. (eds), Explanatory Supplement to
   *     the Astronomical Almanac, 3rd ed., University Science Books
   *     (2013), Section 7.2.
   *
   *  Called:
   *     iauPdp       scalar product of two p-vectors
   *     iauPn        decompose p-vector into modulus and direction
   *
   *  This revision:   2013 October 9
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function iauPmpx($rc, $dc, $pr, $pd, $px, $rv, $pmt, array $pob,
          array &$pco) {

    /* Km/s to au/year */
    $VF = DAYSEC * DJM / DAU;

    /* Light time for 1 au, Julian years */
    $AULTY = AULT / DAYSEC / DJY;

    $i;
    $sr;
    $cr;
    $sd;
    $cd;
    $x;
    $y;
    $z;
    $p  = [];
    $dt;
    $pxr;
    $w;
    $pdz;
    $pm = [];

    /* Spherical coordinates to unit vector (and useful functions). */
    $sr   = sin($rc);
    $cr   = cos($rc);
    $sd   = sin($dc);
    $cd   = cos($dc);
    $p[0] = $x    = $cr * $cd;
    $p[1] = $y    = $sr * $cd;
    $p[2] = $z    = $sd;

    /* Proper motion time interval (y) including Roemer effect. */
    $dt = $pmt + SOFA::iauPdp($p, $pob) * $AULTY;

    /* Space motion (radians per year). */
    $pxr   = $px * DAS2R;
    $w     = $VF * $rv * $pxr;
    $pdz   = $pd * $z;
    $pm[0] = - $pr * $y - $pdz * $cr + $w * $x;
    $pm[1] = $pr * $x - $pdz * $sr + $w * $y;
    $pm[2] = $pd * $cd + $w * $z;

    /* Coordinate direction of star (unit vector, BCRS). */
    for ($i = 0; $i < 3; $i++) {
      $p[$i] += $dt * $pm[$i] - $pxr * $pob[$i];
    }
    SOFA::iauPn($p, $w, $pco);

    /* Finished. */
  }

}
