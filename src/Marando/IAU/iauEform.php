<?php

namespace Marando\IAU;

use \Marando\IAU\iauRefEllips;

trait iauEform {

  /**
   *  - - - - - - - - -
   *   i a u E f o r m
   *  - - - - - - - - -
   *
   *  Earth reference ellipsoids.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  canonical.
   *
   *  Given:
   *     n    int         ellipsoid identifier (Note 1)
   *
   *  Returned:
   *     a    double      equatorial radius (meters, Note 2)
   *     f    double      flattening (Note 2)
   *
   *  Returned (function value):
   *          int         status:  0 = OK
   *                              -1 = illegal identifier (Note 3)
   *
   *  Notes:
   *
   *  1) The identifier n is a number that specifies the choice of
   *     reference ellipsoid.  The following are supported:
   *
   *        n    ellipsoid
   *
   *        1     WGS84
   *        2     GRS80
   *        3     WGS72
   *
   *     The n value has no significance outside the SOFA software.  For
   *     convenience, symbols WGS84 etc. are defined in sofam.h.
   *
   *  2) The ellipsoid parameters are returned in the form of equatorial
   *     radius in meters (a) and flattening (f).  The latter is a number
   *     around 0.00335, i.e. around 1/298.
   *
   *  3) For the case where an unsupported n value is supplied, zero a and
   *     f are returned, as well as error status.
   *
   *  References:
   *
   *     Department of Defense World Geodetic System 1984, National
   *     Imagery and Mapping Agency Technical Report 8350.2, Third
   *     Edition, p3-2.
   *
   *     Moritz, H., Bull. Geodesique 66-2, 187 (1992).
   *
   *     The Department of Defense World Geodetic System 1972, World
   *     Geodetic System Committee, May 1974.
   *
   *     Explanatory Supplement to the Astronomical Almanac,
   *     P. Kenneth Seidelmann (ed), University Science Books (1992),
   *     p220.
   *
   *  This revision:  2013 June 18
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Eform(iauRefEllips $n, &$a, &$f) {
    /* Look up a and f for the specified reference ellipsoid. */
    switch ($n->value) {

      case WGS84:
        $a = 6378137.0;
        $f = 1.0 / 298.257223563;
        break;

      case GRS80:
        $a = 6378137.0;
        $f = 1.0 / 298.257222101;
        break;

      case WGS72:
        $a = 6378135.0;
        $f = 1.0 / 298.26;
        break;

      default:

        /* Invalid identifier. */
        $a = 0.0;
        $f = 0.0;
        return -1;
    }

    /* OK status. */
    return 0;
  }

}
