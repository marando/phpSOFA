<?php

namespace Marando\IAU;

trait iauAb {

  /**
   *  - - - - - -
   *   i a u A b
   *  - - - - - -
   *
   *  Apply aberration to transform natural direction into proper
   *  direction.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *    pnat    double[3]   natural direction to the source (unit vector)
   *    v       double[3]   observer barycentric velocity in units of c
   *    s       double      distance between the Sun and the observer (au)
   *    bm1     double      sqrt(1-|v|^2): reciprocal of Lorenz factor
   *
   *  Returned:
   *    ppr     double[3]   proper direction to source (unit vector)
   *
   *  Notes:
   *
   *  1) The algorithm is based on Expr. (7.40) in the Explanatory
   *     Supplement (Urban & Seidelmann 2013), but with the following
   *     changes:
   *
   *     o  Rigorous rather than approximate normalization is applied.
   *
   *     o  The gravitational potential term from Expr. (7) in
   *        Klioner (2003) is added, taking into account only the Sun's
   *        contribution.  This has a maximum effect of about
   *        0.4 microarcsecond.
   *
   *  2) In almost all cases, the maximum accuracy will be limited by the
   *     supplied velocity.  For example, if the SOFA iauEpv00 function is
   *     used, errors of up to 5 microarcseconds could occur.
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
   *     iauPdp       scalar product of two p-vectors
   *
   *  This revision:   2013 October 9
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function iauAb(array $pnat, array $v, $s, $bm1, array &$ppr) {
    $i;
    $pdv;
    $w1;
    $w2;
    $r2;
    $w;
    $p = [];
    $r;

    $pdv = static::iauPdp($pnat, $v);
    $w1  = 1.0 + $pdv / (1.0 + $bm1);
    $w2  = SRS / $s;
    $r2  = 0.0;
    for ($i = 0; $i < 3; $i++) {
      $w     = $pnat[$i] * $bm1 + $w1 * $v[$i] + $w2 * ($v[$i] -
              $pdv * $pnat[$i]);
      $p[$i] = $w;
      $r2    = $r2 + $w * $w;
    }
    $r = sqrt($r2);
    for ($i = 0; $i < 3; $i++) {
      $ppr[$i] = $p[$i] / $r;
    }
  }

}
