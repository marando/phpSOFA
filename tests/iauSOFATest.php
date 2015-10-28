<?php

use \Marando\IAU\SOFA;
use \Marando\IAU\iauASTROM;

class iauSOFATest extends \PHPUnit_Framework_TestCase {

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

  public function test_iauAper() {
    $theta;
    $astrom = new iauASTROM();

    $astrom->along = 1.234;
    $theta         = 5.678;

    SOFA::iauAper($theta, $astrom);

    $this->assertEquals(6.912000000000000000, $astrom->eral, null, 1e-12);
  }

  public function test_iauIr() {
    $r = [];

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    SOFA::iauIr($r);

    $this->assertEquals(1.0, $r[0][0], null, 0.0);
    $this->assertEquals(0.0, $r[0][1], null, 0.0);
    $this->assertEquals(0.0, $r[0][2], null, 0.0);

    $this->assertEquals(0.0, $r[1][0], null, 0.0);
    $this->assertEquals(1.0, $r[1][1], null, 0.0);
    $this->assertEquals(0.0, $r[1][2], null, 0.0);

    $this->assertEquals(0.0, $r[2][0], null, 0.0);
    $this->assertEquals(0.0, $r[2][1], null, 0.0);
    $this->assertEquals(1.0, $r[2][2], null, 0.0);
  }

  public function test_iauApcs() {
    $date1;
    $date2;
    $pv     = [];
    $ebpv   = [];
    $ehp    = [];
    $astrom = new iauASTROM();

    $date1      = 2456384.5;
    $date2      = 0.970031644;
    $pv[0][0]   = -1836024.09;
    $pv[0][1]   = 1056607.72;
    $pv[0][2]   = -5998795.26;
    $pv[1][0]   = -77.0361767;
    $pv[1][1]   = -133.310856;
    $pv[1][2]   = 0.0971855934;
    $ebpv[0][0] = -0.974170438;
    $ebpv[0][1] = -0.211520082;
    $ebpv[0][2] = -0.0917583024;
    $ebpv[1][0] = 0.00364365824;
    $ebpv[1][1] = -0.0154287319;
    $ebpv[1][2] = -0.00668922024;
    $ehp[0]     = -0.973458265;
    $ehp[1]     = -0.209215307;
    $ehp[2]     = -0.0906996477;

    SOFA::iauApcs($date1, $date2, $pv, $ebpv, $ehp, $astrom);

    $this->assertEquals(13.25248468622587269, $astrom->pmt, "pmt", 1e-11);
    $this->assertEquals(-0.9741827110630456169, $astrom->eb[0], "eb(1)", 1e-12);
    $this->assertEquals(-0.2115130190136085494, $astrom->eb[1], "eb(2)", 1e-12);
    $this->assertEquals(-0.09179840186973175487, $astrom->eb[2], "eb(3)", 1e-12);
    $this->assertEquals(-0.9736425571689386099, $astrom->eh[0], "eh(1)", 1e-12);
    $this->assertEquals(-0.2092452125849967195, $astrom->eh[1], "eh(2)", 1e-12);
    $this->assertEquals(-0.09075578152266466572, $astrom->eh[2], "eh(3)", 1e-12);
    $this->assertEquals(0.9998233241710457140, $astrom->em, "em", 1e-12);
    $this->assertEquals(0.2078704985513566571e-4, $astrom->v[0], "v(1)", 1e-16);
    $this->assertEquals(-0.8955360074245006073e-4, $astrom->v[1], "v(2)", 1e-16);
    $this->assertEquals(-0.3863338980073572719e-4, $astrom->v[2], "v(3)", 1e-16);
    $this->assertEquals(0.9999999950277561601, $astrom->bm1, "bm1", 1e-12);
    $this->assertEquals(1, $astrom->bpn[0][0], "bpn(1,1)", 0);
    $this->assertEquals(0, $astrom->bpn[1][0], "bpn(2,1)", 0);
    $this->assertEquals(0, $astrom->bpn[2][0], "bpn(3,1)", 0);
    $this->assertEquals(0, $astrom->bpn[0][1], "bpn(1,2)", 0);
    $this->assertEquals(1, $astrom->bpn[1][1], "bpn(2,2)", 0);
    $this->assertEquals(0, $astrom->bpn[2][1], "bpn(3,2)", 0);
    $this->assertEquals(0, $astrom->bpn[0][2], "bpn(1,3)", 0);
    $this->assertEquals(0, $astrom->bpn[1][2], "bpn(2,3)", 0);
    $this->assertEquals(1, $astrom->bpn[2][2], "bpn(3,3)", 0);
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

  public function test_iauObl06() {
    $this->assertEquals(0.4090749229387258204,
            SOFA::iauObl06(2400000.5, 54388.0), null, 1e-14);
  }

  public function test_iauObl80() {
    $this->assertEquals(0.4090751347643816218,
            SOFA::iauObl80(2400000.5, 54388.0), null, 1e-14);
  }

  public function test_iauTdbtt() {
    $t1;
    $t2;
    $j;

    $j = SOFA::iauTdbtt(2453750.5, 0.892855137, -0.000201, $t1, $t2);

    $this->assertEquals(2453750.5, $t1, "t1", 1e-6);
    $this->assertEquals($t2, 0.8928551393263888889, "t2", 1e-12);
    $this->assertEquals(0, $j, "j");
  }

  public function test_iauDtdb() {
    $dtdb;

    $dtdb = SOFA::iauDtdb(2448939.5, 0.123, 0.76543, 5.0123, 5525.242, 3190.0);
    $this->assertEquals(-0.1280368005936998991e-2, $dtdb, null, 1e-15);
  }

  public function test_iauEpj() {
    $epj;

    $epj = SOFA::iauEpj(2451545, -7392.5);
    $this->assertEquals(1979.760438056125941, $epj, 1e-12);
  }

  public function test_iauEpj2jd() {
    $epj;
    $djm0;
    $djm;

    $epj = 1996.8;

    SOFA::iauEpj2jd($epj, $djm0, $djm);

    $this->assertEquals(2400000.5, $djm0, "djm0", 1e-9);
    $this->assertEquals(50375.7, $djm, "mjd", 1e-9);
  }

  public function test_iauFal03() {
    $this->assertEquals(5.132369751108684150, SOFA::iauFal03(0.80), 1e-12);
  }

  public function test_iauFaf03() {
    $this->assertEquals(0.2597711366745499518, SOFA::iauFaf03(0.80), 1e-12);
  }

  public function test_iauFaom03() {
    $this->assertEquals(-5.973618440951302183, SOFA::iauFaom03(0.80), 1e-12);
  }

  public function test_iauFame03() {
    $this->assertEquals(5.417338184297289661, SOFA::iauFame03(0.80), 1e-12);
  }

  public function test_iauFave03() {
    $this->assertEquals(3.424900460533758000, SOFA::iauFave03(0.80), 1e-12);
  }

  public function test_iauFae03() {
    $this->assertEquals(1.744713738913081846, SOFA::iauFae03(0.80), 1e-12);
  }

  public function test_iauFama03() {
    $this->assertEquals(3.275506840277781492, SOFA::iauFama03(0.80), 1e-12);
  }

  public function test_iauFaju03() {
    $this->assertEquals(5.275711665202481138, SOFA::iauFaju03(0.80), 1e-12);
  }

  public function test_iauFasa03() {
    $this->assertEquals(5.371574539440827046, SOFA::iauFasa03(0.80), 1e-12);
  }

  public function test_iauFaur03() {
    $this->assertEquals(5.180636450180413523, SOFA::iauFaur03(0.80), 1e-12);
  }

  public function test_iauFapa03() {
    $this->assertEquals(0.1950884762240000000e-1, SOFA::iauFapa03(0.80), 1e-12);
  }

  public function test_iauNut00a() {
    $dpsi;
    $deps;

    SOFA::iauNut00a(2400000.5, 53736.0, $dpsi, $deps);

    $this->assertEquals(-0.9630909107115518431e-5, $dpsi, "dpsi", 1e-13);
    $this->assertEquals(0.4063239174001678710e-4, $deps, "deps", 1e-13);
  }

  public function test_iauNut06a() {
    $dpsi;
    $deps;

    SOFA::iauNut06a(2400000.5, 53736.0, $dpsi, $deps);

    $this->assertEquals(-0.9630912025820308797e-5, $dpsi, "dpsi", 1e-13);
    $this->assertEquals(0.4063238496887249798e-4, $deps, "deps", 1e-13);
  }

  public function test_iauNut00b() {
    $dpsi;
    $deps;

    SOFA::iauNut00b(2400000.5, 53736.0, $dpsi, $deps);

    $this->assertEquals(-0.9632552291148362783e-5, $dpsi, "dpsi", 1e-13);
    $this->assertEquals(0.4063197106621159367e-4, $deps, "deps", 1e-13);
  }

  public function test_iauNut80() {
    $dpsi;
    $deps;

    SOFA::iauNut80(2400000.5, 53736.0, $dpsi, $deps);

    $this->assertEquals(-0.9643658353226563966e-5, $dpsi, "dpsi", 1e-13);
    $this->assertEquals(0.4060051006879713322e-4, $deps, "deps", 1e-13);
  }

}
