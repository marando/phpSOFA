<?php

use \Marando\IAU\SOFA;

class SOFAtest extends \PHPUnit_Framework_TestCase {

  public function test_iauA2af() {
    $s     = '';
    $idmsf = [];

    SOFA::iauA2af(4, 2.345, $s, $idmsf);

    $this->assertEquals('+', $s);
    $this->assertEquals(134, $idmsf[0]);
    $this->assertEquals(21, $idmsf[1]);
    $this->assertEquals(30, $idmsf[2]);
    $this->assertEquals(9706, $idmsf[3]);
  }

  public function test_iauA2tf() {
    $ihmsf = [];
    $s     = '';

    SOFA::iauA2tf(4, -3.01234, $s, $ihmsf);

    $this->assertEquals('-', $s);
    $this->assertEquals(11, $ihmsf[0]);
    $this->assertEquals(30, $ihmsf[1]);
    $this->assertEquals(22, $ihmsf[2]);
    $this->assertEquals(6484, $ihmsf[3]);
  }

  public function test_iauD2tf() {
    $ihmsf = [];
    $s     = '';

    SOFA::iauD2tf(4, -0.987654321, $s, $ihmsf);

    $this->assertEquals('-', $s);
    $this->assertEquals(23, $ihmsf[0]);
    $this->assertEquals(42, $ihmsf[1]);
    $this->assertEquals(13, $ihmsf[2]);
    $this->assertEquals(3333, $ihmsf[3]);
  }

  public function test_iauAb() {
    $pnat = [];
    $v    = [];
    $ppr  = [];

    $pnat[0] = -0.76321968546737951;
    $pnat[1] = -0.60869453983060384;
    $pnat[2] = -0.21676408580639883;
    $v[0]    = 2.1044018893653786e-5;
    $v[1]    = -8.9108923304429319e-5;
    $v[2]    = -3.8633714797716569e-5;
    $s       = 0.99980921395708788;
    $bm1     = 0.99999999506209258;

    SOFA::iauAb($pnat, $v, $s, $bm1, $ppr);

    $this->assertEquals(-0.7631631094219556269, $ppr[0], null, 1e-12);
    $this->assertEquals(-0.6087553082505590832, $ppr[1], null, 1e-12);
    $this->assertEquals(-0.2167926269368471279, $ppr[2], null, 1e-12);
  }

  public function test_iauAf2a() {
    $a;
    $j;


    $j = SOFA::iauAf2a('-', 45, 13, 27.2, $a);

    $this->assertEquals(-0.7893115794313644842, $a, null, 1e-12);
    $this->assertEquals(0, $j);
  }

  public function test_iauAnp() {
    $this->assertEquals(6.183185307179586477, SOFA::iauAnp(-0.1), null, 1e-12);
  }

  public function test_iauAnpm() {
    $this->assertEquals(2.283185307179586477, SOFA::iauAnpm(-4.0), null, 1e-12);
  }

  public function test_iauCp() {
    $p = [];
    $c = [];

    $p[0] = 0.3;
    $p[1] = 1.2;
    $p[2] = -2.5;

    SOFA::iauCp($p, $c);

    $this->assertEquals(0.3, $c[0], null, 0.0);
    $this->assertEquals(1.2, $c[1], null, 0.0);
    $this->assertEquals(-2.5, $c[2], null, 0.0);
  }

  public function test_iauPm() {
    $p = [];
    $r;

    $p[0] = 0.3;
    $p[1] = 1.2;
    $p[2] = -2.5;

    $r = SOFA::iauPm($p);

    $this->assertEquals(2.789265136196270604, $r, null, 1e-12);
  }

  public function test_iauZp() {
    $p = [];

    $p[0] = 0.3;
    $p[1] = 1.2;
    $p[2] = -2.5;

    SOFA::iauZp($p);

    $this->assertEquals(0.0, $p[0], null, 0.0);
    $this->assertEquals(0.0, $p[1], null, 0.0);
    $this->assertEquals(0.0, $p[2], null, 0.0);
  }

  public function test_iauSxp() {
    $s;
    $p  = [];
    $sp = [];

    $s = 2.0;

    $p[0] = 0.3;
    $p[1] = 1.2;
    $p[2] = -2.5;

    SOFA::iauSxp($s, $p, $sp);

    $this->assertEquals(0.6, $sp[0], null, 0.0);
    $this->assertEquals(2.4, $sp[1], null, 0.0);
    $this->assertEquals(-5.0, $sp[2], null, 0.0);
  }

  public function test_iauPn() {
    $p = [];
    $r;
    $u = [];

    $p[0] = 0.3;
    $p[1] = 1.2;
    $p[2] = -2.5;

    SOFA::iauPn($p, $r, $u);

    $this->assertEquals(2.789265136196270604, $r, null, 1e-12);

    $this->assertEquals(0.1075552109073112058, $u[0], null, 1e-12);
    $this->assertEquals(0.4302208436292448232, $u[1], null, 1e-12);
    $this->assertEquals(-0.8962934242275933816, $u[2], null, 1e-12);
  }

  public function test_iauPdp() {
    $a   = [];
    $b   = [];
    $adb = 0;

    $a[0] = 2.0;
    $a[1] = 2.0;
    $a[2] = 3.0;

    $b[0] = 1.0;
    $b[1] = 3.0;
    $b[2] = 4.0;

    $adb = SOFA::iauPdp($a, $b);

    $this->assertEquals(20, $adb, null, 1e-12);
  }

}
