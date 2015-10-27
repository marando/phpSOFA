<?php

namespace Marando\IAU;

/**
 * Star-independent astrometry parameters
 * (Vectors eb, eh, em and v are all with respect to BCRS axes.)
 */
class iauASTROM {

  /**
   * PM time interval (SSB, Julian years)
   * @var float
   */
  public $pmt;

  /**
   * SSB to observer (vector, au)
   * @var array
   */
  public $eb = [];

  /**
   * Sun to observer (unit vector)
   * @var array
   */
  public $eh = [];

  /**
   * distance from Sun to observer (au)
   * @var float
   */
  public $em;

  /**
   * barycentric observer velocity (vector, c)
   * @var array
   */
  public $v = [];

  /**
   * sqrt(1-|v|^2): reciprocal of Lorenz factor
   * @var float
   */
  public $bm1;

  /**
   * bias-precession-nutation matrix
   * @var array
   */
  public $bpn = [];

  /**
   * longitude + s' + dERA(DUT) (radians)
   * @var float
   */
  public $along;

  /**
   * geodetic latitude (radians)
   * @var float
   */
  public $phi;

  /**
   * polar motion xp wrt local meridian (radians)
   * @var float
   */
  public $xpl;

  /**
   * polar motion yp wrt local meridian (radians)
   * @var float
   */
  public $ypl;

  /**
   * sine of geodetic latitude
   * @var float
   */
  public $sphi;

  /**
   * cosine of geodetic latitude
   * @var float
   */
  public $cphi;

  /**
   * magnitude of diurnal aberration vector
   * @var float
   */
  public $diurab;

  /**
   * "local" Earth rotation angle (radians)
   * @var float
   */
  public $eral;

  /**
   * refraction constant A (radians)
   * @var float
   */
  public $refa;

  /**
   * refraction constant B (radians)
   * @var float
   */
  public $refb;

}
