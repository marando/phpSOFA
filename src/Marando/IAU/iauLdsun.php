<?php

namespace Marando\IAU;

trait iauLdsun {

  /**
   *  - - - - - - - - -
   *   i a u L d s u n
   *  - - - - - - - - -
   *
   *  Deflection of starlight by the Sun.
   *
   *  This function is part of the International Astronomical Union's
   *  SOFA (Standards of Fundamental Astronomy) software collection.
   *
   *  Status:  support function.
   *
   *  Given:
   *     p      double[3]  direction from observer to star (unit vector)
   *     e      double[3]  direction from Sun to observer (unit vector)
   *     em     double     distance from Sun to observer (au)
   *
   *  Returned:
   *     p1     double[3]  observer to deflected star (unit vector)
   *
   *  Notes:
   *
   *  1) The source is presumed to be sufficiently distant that its
   *     directions seen from the Sun and the observer are essentially
   *     the same.
   *
   *  2) The deflection is restrained when the angle between the star and
   *     the center of the Sun is less than about 9 arcsec, falling to
   *     zero for zero separation. (The chosen threshold is within the
   *     solar limb for all solar-system applications.)
   *
   *  3) The arguments p and p1 can be the same array.
   *
   *  Called:
   *     iauLd        light deflection by a solar-system body
   *
   *  This revision:   2014 September 1
   *
   *  SOFA release 2015-02-09
   *
   *  Copyright (C) 2015 IAU SOFA Board.  See notes at end.
   */
  public static function Ldsun(array $p, array $e, $em, array &$p1) {
    IAU::Ld(1.0, $p, $p, $e, $em, 1e-9, $p1);

    /* Finished. */
  }

}
