<?php

namespace Marando\IAU;

trait iauPvtob {

  /**
   *  - - - - - - - - -
   *   i a u P v t o b
   *  - - - - - - - - -
   *
   *  Position and velocity of a terrestrial observing station.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     elong   double       longitude (radians, east +ve, Note 1)
   *     phi     double       latitude (geodetic, radians, Note 1)
   *     hm      double       height above ref. ellipsoid (geodetic, m)
   *     xp,yp   double       coordinates of the pole (radians, Note 2)
   *     sp      double       the TIO locator s' (radians, Note 2)
   *     theta   double       Earth rotation angle (radians, Note 3)
   *
   *  Returned:
   *     pv      double[2][3] position/velocity vector (m, m/s, CIRS)
   *
   *  Notes:
   *
   *  1) The terrestrial coordinates are with respect to the WGS84
   *     reference ellipsoid.
   *
   *  2) xp and yp are the coordinates (in radians) of the Celestial
   *     Intermediate Pole with respect to the International Terrestrial
   *     Reference System (see IERS Conventions), measured along the
   *     meridians 0 and 90 deg west respectively.  sp is the TIO locator
   *     s', in radians, which positions the Terrestrial Intermediate
   *     Origin on the equator.  For many applications, xp, yp and
   *     (especially) sp can be set to zero.
   *
   *  3) If theta is Greenwich apparent sidereal time instead of Earth
   *     rotation angle, the result is with respect to the true equator
   *     and equinox of date, i.e. with the x-axis at the equinox rather
   *     than the celestial intermediate origin.
   *
   *  4) The velocity units are meters per UT1 second, not per SI second.
   *     This is unlikely to have any practical consequences in the modern
   *     era.
   *
   *  5) No validation is performed on the arguments.  Error cases that
   *     could lead to arithmetic exceptions are trapped by the iauGd2gc
   *     function, and the result set to zeros.
   *
   *  References:
   *
   *     McCarthy, D. D., Petit, G. (eds.), IERS Conventions (2003),
   *     IERS Technical Note No. 32, BKG (2004)
   *
   *     Urban, S. & Seidelmann, P. K. (eds), Explanatory Supplement to
   *     the Astronomical Almanac, 3rd ed., University Science Books
   *     (2013), Section 7.4.3.3.
   *
   *  Called:
   *     iauGd2gc     geodetic to geocentric transformation
   *     iauPom00     polar motion matrix
   *     iauTrxp      product of transpose of r-matrix and p-vector
   *
   *  This revision:   2013 October 9
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Pvtob($elong, $phi, $hm, $xp, $yp, $sp, $theta,
          array &$pv) {

    /* Earth rotation rate in radians per UT1 second */
    $OM = 1.00273781191135448 * D2PI / DAYSEC;

    $xyzm = [];
    $rpm  = [];
    $xyz  = [];
    $x;
    $y;
    $z;
    $s;
    $c;

    /* Geodetic to geocentric transformation (WGS84). */
    IAU::Gd2gc(iauRefEllips::WGS84(), $elong, $phi, $hm, $xyzm);

    /* Polar motion and TIO position. */
    IAU::Pom00($xp, $yp, $sp, $rpm);
    IAU::Trxp($rpm, $xyzm, $xyz);
    $x = $xyz[0];
    $y = $xyz[1];
    $z = $xyz[2];

    /* Functions of ERA. */
    $s = sin($theta);
    $c = cos($theta);

    /* Position. */
    $pv[0][0] = $c * $x - $s * $y;
    $pv[0][1] = $s * $x + $c * $y;
    $pv[0][2] = $z;

    /* Velocity. */
    $pv[1][0] = $OM * ( -$s * $x - $c * $y );
    $pv[1][1] = $OM * ( $c * $x - $s * $y );
    $pv[1][2] = 0.0;

    /* Finished. */
  }

}
