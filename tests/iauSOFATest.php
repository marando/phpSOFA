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

  public function test_iauGmst00() {
    $theta;

    $theta = SOFA::iauGmst00(2400000.5, 53736.0, 2400000.5, 53736.0);
    $this->assertEquals(1.754174972210740592, $theta, null, 1e-12);
  }

  public function test_iauEra00() {
    $era00;

    $era00 = SOFA::iauEra00(2400000.5, 54388.0);
    $this->assertEquals(0.4022837240028158102, $era00, null, 1e-12);
  }

  public function test_iauGmst06() {
    $theta;

    $theta = SOFA::iauGmst06(2400000.5, 53736.0, 2400000.5, 53736.0);
    $this->assertEquals(1.754174971870091203, $theta, null, 1e-12);
  }

  public function test_iauGmst82() {
    $theta;

    $theta = SOFA::iauGmst82(2400000.5, 53736.0);
    $this->assertEquals(1.754174981860675096, $theta, null, 1e-12);
  }

  public function test_iauGst00a() {
    $theta;

    $theta = SOFA::iauGst00a(2400000.5, 53736.0, 2400000.5, 53736.0);
    $this->assertEquals(1.754166138018281369, $theta, null, 1e-12);
  }

  public function test_iauEe00a() {
    $ee;

    $ee = SOFA::iauEe00a(2400000.5, 53736.0);
    $this->assertEquals(-0.8834192459222588227e-5, $ee, null, 1e-18);
  }

  public function test_iauPr00() {
    $dpsipr;
    $depspr;

    SOFA::iauPr00(2400000.5, 53736, $dpsipr, $depspr);

    $this->assertEquals(-0.8716465172668347629e-7, $dpsipr, null, 1e-22);
    $this->assertEquals(-0.7342018386722813087e-8, $depspr, null, 1e-22);
  }

  public function test_iauEe00() {
    $epsa;
    $dpsi;
    $ee;

    $epsa = 0.4090789763356509900;
    $dpsi = -0.9630909107115582393e-5;

    $ee = SOFA::iauEe00(2400000.5, 53736.0, $epsa, $dpsi);
    $this->assertEquals(-0.8834193235367965479e-5, $ee, null, 1e-18);
  }

  public function test_iauEect00() {
    $eect;

    $eect = SOFA::iauEect00(2400000.5, 53736.0);
    $this->assertEquals(0.204608500488125264e-8, $eect, null, 1e-20);
  }

  public function test_iauFalp03() {
    $this->assertEquals(6.226797973505507345, SOFA::iauFalp03(0.80), null, 1e-12);
  }

  public function test_iauFad03() {
    $this->assertEquals(1.946709205396925672, SOFA::iauFad03(0.80), null, 1e-12);
  }

  public function test_iauRefco() {
    $phpa;
    $tc;
    $rh;
    $wl;
    $refa;
    $refb;

    $phpa = 800.0;
    $tc   = 10.0;
    $rh   = 0.9;
    $wl   = 0.4;

    SOFA::iauRefco($phpa, $tc, $rh, $wl, $refa, $refb);

    $this->assertEquals(0.2264949956241415009e-3, $refa, "refa", 1e-15);
    $this->assertEquals(-0.2598658261729343970e-6, $refb, "refb", 1e-18);
  }

  public function test_iauC2s() {
    $p;
    $theta;
    $phi;

    $p[0] = 100.0;
    $p[1] = -50.0;
    $p[2] = 25.0;

    SOFA::iauC2s($p, $theta, $phi);
    $this->assertEquals(-0.4636476090008061162, $theta, "theta", 1e-14);
    $this->assertEquals(0.2199879773954594463, $phi, "phi", 1e-14);
  }

  public function test_iauS2c() {
    $c = [];

    SOFA::iauS2c(3.0123, -0.999, $c);

    $this->assertEquals(-0.5366267667260523906, $c[0], "1", 1e-12);
    $this->assertEquals(0.0697711109765145365, $c[1], "2", 1e-12);
    $this->assertEquals(-0.8409302618566214041, $c[2], "3", 1e-12);
  }

  public function test_iauCpv() {
    $pv = [];
    $c  = [];

    $pv[0][0] = 0.3;
    $pv[0][1] = 1.2;
    $pv[0][2] = -2.5;

    $pv[1][0] = -0.5;
    $pv[1][1] = 3.1;
    $pv[1][2] = 0.9;

    SOFA::iauCpv($pv, $c);

    $this->assertEquals(0.3, $c[0][0], "p1", 0.0);
    $this->assertEquals(1.2, $c[0][1], "p2", 0.0);
    $this->assertEquals(-2.5, $c[0][2], "p3", 0.0);

    $this->assertEquals(-0.5, $c[1][0], "v1", 0.0);
    $this->assertEquals(3.1, $c[1][1], "v2", 0.0);
    $this->assertEquals(0.9, $c[1][2], "v3", 0.0);
  }

  public function test_iauApcg() {
    $date1;
    $date2;
    $ebpv   = [];
    $ehp    = [];
    $astrom = new iauASTROM();

    $date1      = 2456165.5;
    $date2      = 0.401182685;
    $ebpv[0][0] = 0.901310875;
    $ebpv[0][1] = -0.417402664;
    $ebpv[0][2] = -0.180982288;
    $ebpv[1][0] = 0.00742727954;
    $ebpv[1][1] = 0.0140507459;
    $ebpv[1][2] = 0.00609045792;
    $ehp[0]     = 0.903358544;
    $ehp[1]     = -0.415395237;
    $ehp[2]     = -0.180084014;

    SOFA::iauApcg($date1, $date2, $ebpv, $ehp, $astrom);

    $this->assertEquals(12.65133794027378508, $astrom->pmt, "pmt", 1e-11);
    $this->assertEquals(0.901310875, $astrom->eb[0], "eb(1)", 1e-12);
    $this->assertEquals(-0.417402664, $astrom->eb[1], "eb(2)", 1e-12);
    $this->assertEquals(-0.180982288, $astrom->eb[2], "eb(3)", 1e-12);
    $this->assertEquals(0.8940025429324143045, $astrom->eh[0], "eh(1)", 1e-12);
    $this->assertEquals(-0.4110930268679817955, $astrom->eh[1], "eh(2)", 1e-12);
    $this->assertEquals(-0.1782189004872870264, $astrom->eh[2], "eh(3)", 1e-12);
    $this->assertEquals(1.010465295811013146, $astrom->em, "em", 1e-12);
    $this->assertEquals(0.4289638897813379954e-4, $astrom->v[0], "v(1_", 1e-16);
    $this->assertEquals(0.8115034021720941898e-4, $astrom->v[1], "v(2)", 1e-16);
    $this->assertEquals(0.3517555123437237778e-4, $astrom->v[2], "v(3)", 1e-16);
    $this->assertEquals(0.9999999951686013336, $astrom->bm1, "bm1", 1e-12);
    $this->assertEquals(1.0, $astrom->bpn[0][0], "bpn(1,1)", 0.0);
    $this->assertEquals(0.0, $astrom->bpn[1][0], "bpn(2,1)", 0.0);
    $this->assertEquals(0.0, $astrom->bpn[2][0], "bpn(3,1)", 0.0);
    $this->assertEquals(0.0, $astrom->bpn[0][1], "bpn(1,2)", 0.0);
    $this->assertEquals(1.0, $astrom->bpn[1][1], "bpn(2,2)", 0.0);
    $this->assertEquals(0.0, $astrom->bpn[2][1], "bpn(3,2)", 0.0);
    $this->assertEquals(0.0, $astrom->bpn[0][2], "bpn(1,3)", 0.0);
    $this->assertEquals(0.0, $astrom->bpn[1][2], "bpn(2,3)", 0.0);
    $this->assertEquals(1.0, $astrom->bpn[2][2], "bpn(3,3)", 0.0);
  }

  public function test_iauBi00() {
    $dpsibi;
    $depsbi;
    $dra;

    SOFA::iauBi00($dpsibi, $depsbi, $dra);

    $this->assertEquals(-0.2025309152835086613e-6, $dpsibi, "dpsibi", 1e-12);
    $this->assertEquals(-0.3306041454222147847e-7, $depsbi, "depsbi", 1e-12);
    $this->assertEquals(-0.7078279744199225506e-7, $dra, "dra", 1e-12);
  }

  public function test_iauRx() {
    $phi;
    $r = [];

    $phi = 0.3456789;

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    SOFA::iauRx($phi, $r);

    $this->assertEquals(2.0, $r[0][0], "11", 0.0);
    $this->assertEquals(3.0, $r[0][1], "12", 0.0);
    $this->assertEquals(2.0, $r[0][2], "13", 0.0);

    $this->assertEquals(3.839043388235612460, $r[1][0], "21", 1e-12);
    $this->assertEquals(3.237033249594111899, $r[1][1], "22", 1e-12);
    $this->assertEquals(4.516714379005982719, $r[1][2], "23", 1e-12);

    $this->assertEquals(1.806030415924501684, $r[2][0], "31", 1e-12);
    $this->assertEquals(3.085711545336372503, $r[2][1], "32", 1e-12);
    $this->assertEquals(3.687721683977873065, $r[2][2], "33", 1e-12);
  }

  public function test_iauRy() {
    $theta;
    $r = [];

    $theta = 0.3456789;

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    SOFA::iauRy($theta, $r);

    $this->assertEquals(0.8651847818978159930, $r[0][0], "11", 1e-12);
    $this->assertEquals(1.467194920539316554, $r[0][1], "12", 1e-12);
    $this->assertEquals(0.1875137911274457342, $r[0][2], "13", 1e-12);

    $this->assertEquals(3, $r[1][0], "21", 1e-12);
    $this->assertEquals(2, $r[1][1], "22", 1e-12);
    $this->assertEquals(3, $r[1][2], "23", 1e-12);

    $this->assertEquals(3.500207892850427330, $r[2][0], "31", 1e-12);
    $this->assertEquals(4.779889022262298150, $r[2][1], "32", 1e-12);
    $this->assertEquals(5.381899160903798712, $r[2][2], "33", 1e-12);
  }

  public function test_iauRz() {
    $psi;
    $r = [];

    $psi = 0.3456789;

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    SOFA::iauRz($psi, $r);

    $this->assertEquals(2.898197754208926769, $r[0][0], "11", 1e-12);
    $this->assertEquals(3.500207892850427330, $r[0][1], "12", 1e-12);
    $this->assertEquals(2.898197754208926769, $r[0][2], "13", 1e-12);

    $this->assertEquals(2.144865911309686813, $r[1][0], "21", 1e-12);
    $this->assertEquals(0.865184781897815993, $r[1][1], "22", 1e-12);
    $this->assertEquals(2.144865911309686813, $r[1][2], "23", 1e-12);

    $this->assertEquals(3.0, $r[2][0], "31", 1e-12);
    $this->assertEquals(4.0, $r[2][1], "32", 1e-12);
    $this->assertEquals(5.0, $r[2][2], "33", 1e-12);
  }

  public function test_iauCr() {
    $r = [];
    $c = [];

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    SOFA::iauCr($r, $c);

    $this->assertEquals(2.0, $c[0][0], "11", 0.0);
    $this->assertEquals(3.0, $c[0][1], "12", 0.0);
    $this->assertEquals(2.0, $c[0][2], "13", 0.0);

    $this->assertEquals(3.0, $c[1][0], "21", 0.0);
    $this->assertEquals(2.0, $c[1][1], "22", 0.0);
    $this->assertEquals(3.0, $c[1][2], "23", 0.0);

    $this->assertEquals(3.0, $c[2][0], "31", 0.0);
    $this->assertEquals(4.0, $c[2][1], "32", 0.0);
    $this->assertEquals(5.0, $c[2][2], "33", 0.0);
  }

  public function test_iauBp00() {
    $rb  = [];
    $rp  = [];
    $rbp = [];

    SOFA::iauBp00(2400000.5, 50123.9999, $rb, $rp, $rbp);

    $this->assertEquals(0.9999999999999942498, $rb[0][0], "rb11", 1e-12);
    $this->assertEquals(-0.7078279744199196626e-7, $rb[0][1], "rb12", 1e-16);
    $this->assertEquals(0.8056217146976134152e-7, $rb[0][2], "rb13", 1e-16);
    $this->assertEquals(0.7078279477857337206e-7, $rb[1][0], "rb21", 1e-16);
    $this->assertEquals(0.9999999999999969484, $rb[1][1], "rb22", 1e-12);
    $this->assertEquals(0.3306041454222136517e-7, $rb[1][2], "rb23", 1e-16);
    $this->assertEquals(-0.8056217380986972157e-7, $rb[2][0], "rb31", 1e-16);
    $this->assertEquals(-0.3306040883980552500e-7, $rb[2][1], "rb32", 1e-16);
    $this->assertEquals(0.9999999999999962084, $rb[2][2], "rb33", 1e-12);

    $this->assertEquals(0.9999995504864048241, $rp[0][0], "rp11", 1e-12);
    $this->assertEquals(0.8696113836207084411e-3, $rp[0][1], "rp12", 1e-14);
    $this->assertEquals(0.3778928813389333402e-3, $rp[0][2], "rp13", 1e-14);
    $this->assertEquals(-0.8696113818227265968e-3, $rp[1][0], "rp21", 1e-14);
    $this->assertEquals(0.9999996218879365258, $rp[1][1], "rp22", 1e-12);
    $this->assertEquals(-0.1690679263009242066e-6, $rp[1][2], "rp23", 1e-14);
    $this->assertEquals(-0.3778928854764695214e-3, $rp[2][0], "rp31", 1e-14);
    $this->assertEquals(-0.1595521004195286491e-6, $rp[2][1], "rp32", 1e-14);
    $this->assertEquals(0.9999999285984682756, $rp[2][2], "rp33", 1e-12);

    $this->assertEquals(0.9999995505175087260, $rbp[0][0], "rbp11", 1e-12);
    $this->assertEquals(0.8695405883617884705e-3, $rbp[0][1], "rbp12", 1e-14);
    $this->assertEquals(0.3779734722239007105e-3, $rbp[0][2], "rbp13", 1e-14);
    $this->assertEquals(-0.8695405990410863719e-3, $rbp[1][0], "rbp21", 1e-14);
    $this->assertEquals(0.9999996219494925900, $rbp[1][1], "rbp22", 1e-12);
    $this->assertEquals(-0.1360775820404982209e-6, $rbp[1][2], "rbp23", 1e-14);
    $this->assertEquals(-0.3779734476558184991e-3, $rbp[2][0], "rbp31", 1e-14);
    $this->assertEquals(-0.1925857585832024058e-6, $rbp[2][1], "rbp32", 1e-14);
    $this->assertEquals(0.9999999285680153377, $rbp[2][2], "rbp33", 1e-12);
  }

  public function test_iauRxr() {
    $a   = [];
    $b   = [];
    $atb = [];

    $a[0][0] = 2.0;
    $a[0][1] = 3.0;
    $a[0][2] = 2.0;

    $a[1][0] = 3.0;
    $a[1][1] = 2.0;
    $a[1][2] = 3.0;

    $a[2][0] = 3.0;
    $a[2][1] = 4.0;
    $a[2][2] = 5.0;

    $b[0][0] = 1.0;
    $b[0][1] = 2.0;
    $b[0][2] = 2.0;

    $b[1][0] = 4.0;
    $b[1][1] = 1.0;
    $b[1][2] = 1.0;

    $b[2][0] = 3.0;
    $b[2][1] = 0.0;
    $b[2][2] = 1.0;

    SOFA::iauRxr($a, $b, $atb);

    $this->assertEquals(20.0, $atb[0][0], "11", 1e-12);
    $this->assertEquals(7.0, $atb[0][1], "12", 1e-12);
    $this->assertEquals(9.0, $atb[0][2], "13", 1e-12);

    $this->assertEquals(20.0, $atb[1][0], "21", 1e-12);
    $this->assertEquals(8.0, $atb[1][1], "22", 1e-12);
    $this->assertEquals(11.0, $atb[1][2], "23", 1e-12);

    $this->assertEquals(34.0, $atb[2][0], "31", 1e-12);
    $this->assertEquals(10.0, $atb[2][1], "32", 1e-12);
    $this->assertEquals(15.0, $atb[2][2], "33", 1e-12);
  }

  public function test_iauPmpx() {
    $rc;
    $dc;
    $pr;
    $pd;
    $px;
    $rv;
    $pmt;
    $pob = [];
    $pco = [];

    $rc     = 1.234;
    $dc     = 0.789;
    $pr     = 1e-5;
    $pd     = -2e-5;
    $px     = 1e-2;
    $rv     = 10.0;
    $pmt    = 8.75;
    $pob[0] = 0.9;
    $pob[1] = 0.4;
    $pob[2] = 0.1;

    SOFA::iauPmpx($rc, $dc, $pr, $pd, $px, $rv, $pmt, $pob, $pco);

    $this->assertEquals(0.2328137623960308440, $pco[0], "1", 1e-12);
    $this->assertEquals(0.6651097085397855317, $pco[1], "2", 1e-12);
    $this->assertEquals(0.7095257765896359847, $pco[2], "3", 1e-12);
  }

}
