<?php

use \Marando\IAU\IAU;
use \Marando\IAU\iauASTROM;
use \Marando\IAU\iauRefEllips;
use \Marando\IAU\iauLDBODY;

class iauSOFATest extends PHPUnit_Framework_TestCase {

  public function test_iauA2af() {
    $s     = '';
    $idmsf = [];

    IAU::A2af(4, 2.345, $s, $idmsf);

    $this->assertEquals('+', $s);
    $this->assertEquals(134, $idmsf[0]);
    $this->assertEquals(21, $idmsf[1]);
    $this->assertEquals(30, $idmsf[2]);
    $this->assertEquals(9706, $idmsf[3]);
  }

  public function test_iauA2tf() {
    $ihmsf = [];
    $s     = '';

    IAU::A2tf(4, -3.01234, $s, $ihmsf);

    $this->assertEquals('-', $s);
    $this->assertEquals(11, $ihmsf[0]);
    $this->assertEquals(30, $ihmsf[1]);
    $this->assertEquals(22, $ihmsf[2]);
    $this->assertEquals(6484, $ihmsf[3]);
  }

  public function test_iauD2tf() {
    $ihmsf = [];
    $s     = '';

    IAU::D2tf(4, -0.987654321, $s, $ihmsf);

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

    IAU::Ab($pnat, $v, $s, $bm1, $ppr);

    $this->assertEquals(-0.7631631094219556269, $ppr[0], null, 1e-12);
    $this->assertEquals(-0.6087553082505590832, $ppr[1], null, 1e-12);
    $this->assertEquals(-0.2167926269368471279, $ppr[2], null, 1e-12);
  }

  public function test_iauAf2a() {
    $a;
    $j;


    $j = IAU::Af2a('-', 45, 13, 27.2, $a);

    $this->assertEquals(-0.7893115794313644842, $a, null, 1e-12);
    $this->assertEquals(0, $j);
  }

  public function test_iauAnp() {
    $this->assertEquals(6.183185307179586477, IAU::Anp(-0.1), null, 1e-12);
  }

  public function test_iauAnpm() {
    $this->assertEquals(2.283185307179586477, IAU::Anpm(-4.0), null, 1e-12);
  }

  public function test_iauCp() {
    $p = [];
    $c = [];

    $p[0] = 0.3;
    $p[1] = 1.2;
    $p[2] = -2.5;

    IAU::Cp($p, $c);

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

    $r = IAU::Pm($p);

    $this->assertEquals(2.789265136196270604, $r, null, 1e-12);
  }

  public function test_iauZp() {
    $p = [];

    $p[0] = 0.3;
    $p[1] = 1.2;
    $p[2] = -2.5;

    IAU::Zp($p);

    $this->assertEquals(0.0, $p[0], null, 0.0);
    $this->assertEquals(0.0, $p[1], null, 0.0);
    $this->assertEquals(0.0, $p[2], null, 0.0);
  }

  public function test_iauAper() {
    $theta;
    $astrom = new iauASTROM();

    $astrom->along = 1.234;
    $theta         = 5.678;

    IAU::Aper($theta, $astrom);

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

    IAU::Ir($r);

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

    IAU::Apcs($date1, $date2, $pv, $ebpv, $ehp, $astrom);

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

    IAU::Sxp($s, $p, $sp);

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

    IAU::Pn($p, $r, $u);

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

    $adb = IAU::Pdp($a, $b);

    $this->assertEquals(20, $adb, null, 1e-12);
  }

  public function test_iauObl06() {
    $this->assertEquals(0.4090749229387258204, IAU::Obl06(2400000.5, 54388.0),
            null, 1e-14);
  }

  public function test_iauObl80() {
    $this->assertEquals(0.4090751347643816218, IAU::Obl80(2400000.5, 54388.0),
            null, 1e-14);
  }

  public function test_iauTdbtt() {
    $t1;
    $t2;
    $j;

    $j = IAU::Tdbtt(2453750.5, 0.892855137, -0.000201, $t1, $t2);

    $this->assertEquals(2453750.5, $t1, "t1", 1e-6);
    $this->assertEquals($t2, 0.8928551393263888889, "t2", 1e-12);
    $this->assertEquals(0, $j, "j");
  }

  public function test_iauDtdb() {
    $dtdb;

    $dtdb = IAU::Dtdb(2448939.5, 0.123, 0.76543, 5.0123, 5525.242, 3190.0);
    $this->assertEquals(-0.1280368005936998991e-2, $dtdb, null, 1e-15);
  }

  public function test_iauEpj() {
    $epj;

    $epj = IAU::Epj(2451545, -7392.5);
    $this->assertEquals(1979.760438056125941, $epj, 1e-12);
  }

  public function test_iauEpj2jd() {
    $epj;
    $djm0;
    $djm;

    $epj = 1996.8;

    IAU::Epj2jd($epj, $djm0, $djm);

    $this->assertEquals(2400000.5, $djm0, "djm0", 1e-9);
    $this->assertEquals(50375.7, $djm, "mjd", 1e-9);
  }

  public function test_iauFal03() {
    $this->assertEquals(5.132369751108684150, IAU::Fal03(0.80), 1e-12);
  }

  public function test_iauFaf03() {
    $this->assertEquals(0.2597711366745499518, IAU::Faf03(0.80), 1e-12);
  }

  public function test_iauFaom03() {
    $this->assertEquals(-5.973618440951302183, IAU::Faom03(0.80), 1e-12);
  }

  public function test_iauFame03() {
    $this->assertEquals(5.417338184297289661, IAU::Fame03(0.80), 1e-12);
  }

  public function test_iauFave03() {
    $this->assertEquals(3.424900460533758000, IAU::Fave03(0.80), 1e-12);
  }

  public function test_iauFae03() {
    $this->assertEquals(1.744713738913081846, IAU::Fae03(0.80), 1e-12);
  }

  public function test_iauFama03() {
    $this->assertEquals(3.275506840277781492, IAU::Fama03(0.80), 1e-12);
  }

  public function test_iauFaju03() {
    $this->assertEquals(5.275711665202481138, IAU::Faju03(0.80), 1e-12);
  }

  public function test_iauFasa03() {
    $this->assertEquals(5.371574539440827046, IAU::Fasa03(0.80), 1e-12);
  }

  public function test_iauFaur03() {
    $this->assertEquals(5.180636450180413523, IAU::Faur03(0.80), 1e-12);
  }

  public function test_iauFapa03() {
    $this->assertEquals(0.1950884762240000000e-1, IAU::Fapa03(0.80), 1e-12);
  }

  public function test_iauNut00a() {
    $dpsi;
    $deps;

    IAU::Nut00a(2400000.5, 53736.0, $dpsi, $deps);

    $this->assertEquals(-0.9630909107115518431e-5, $dpsi, "dpsi", 1e-13);
    $this->assertEquals(0.4063239174001678710e-4, $deps, "deps", 1e-13);
  }

  public function test_iauNut06a() {
    $dpsi;
    $deps;

    IAU::Nut06a(2400000.5, 53736.0, $dpsi, $deps);

    $this->assertEquals(-0.9630912025820308797e-5, $dpsi, "dpsi", 1e-13);
    $this->assertEquals(0.4063238496887249798e-4, $deps, "deps", 1e-13);
  }

  public function test_iauNut00b() {
    $dpsi;
    $deps;

    IAU::Nut00b(2400000.5, 53736.0, $dpsi, $deps);

    $this->assertEquals(-0.9632552291148362783e-5, $dpsi, "dpsi", 1e-13);
    $this->assertEquals(0.4063197106621159367e-4, $deps, "deps", 1e-13);
  }

  public function test_iauNut80() {
    $dpsi;
    $deps;

    IAU::Nut80(2400000.5, 53736.0, $dpsi, $deps);

    $this->assertEquals(-0.9643658353226563966e-5, $dpsi, "dpsi", 1e-13);
    $this->assertEquals(0.4060051006879713322e-4, $deps, "deps", 1e-13);
  }

  public function test_iauGmst00() {
    $theta;

    $theta = IAU::Gmst00(2400000.5, 53736.0, 2400000.5, 53736.0);
    $this->assertEquals(1.754174972210740592, $theta, null, 1e-12);
  }

  public function test_iauEra00() {
    $era00;

    $era00 = IAU::Era00(2400000.5, 54388.0);
    $this->assertEquals(0.4022837240028158102, $era00, null, 1e-12);
  }

  public function test_iauGmst06() {
    $theta;

    $theta = IAU::Gmst06(2400000.5, 53736.0, 2400000.5, 53736.0);
    $this->assertEquals(1.754174971870091203, $theta, null, 1e-12);
  }

  public function test_iauGmst82() {
    $theta;

    $theta = IAU::Gmst82(2400000.5, 53736.0);
    $this->assertEquals(1.754174981860675096, $theta, null, 1e-12);
  }

  public function test_iauGst00a() {
    $theta;

    $theta = IAU::Gst00a(2400000.5, 53736.0, 2400000.5, 53736.0);
    $this->assertEquals(1.754166138018281369, $theta, null, 1e-12);
  }

  public function test_iauEe00a() {
    $ee;

    $ee = IAU::Ee00a(2400000.5, 53736.0);
    $this->assertEquals(-0.8834192459222588227e-5, $ee, null, 1e-18);
  }

  public function test_iauPr00() {
    $dpsipr;
    $depspr;

    IAU::Pr00(2400000.5, 53736, $dpsipr, $depspr);

    $this->assertEquals(-0.8716465172668347629e-7, $dpsipr, null, 1e-22);
    $this->assertEquals(-0.7342018386722813087e-8, $depspr, null, 1e-22);
  }

  public function test_iauEe00() {
    $epsa;
    $dpsi;
    $ee;

    $epsa = 0.4090789763356509900;
    $dpsi = -0.9630909107115582393e-5;

    $ee = IAU::Ee00(2400000.5, 53736.0, $epsa, $dpsi);
    $this->assertEquals(-0.8834193235367965479e-5, $ee, null, 1e-18);
  }

  public function test_iauEect00() {
    $eect;

    $eect = IAU::Eect00(2400000.5, 53736.0);
    $this->assertEquals(0.204608500488125264e-8, $eect, null, 1e-20);
  }

  public function test_iauFalp03() {
    $this->assertEquals(6.226797973505507345, IAU::Falp03(0.80), null, 1e-12);
  }

  public function test_iauFad03() {
    $this->assertEquals(1.946709205396925672, IAU::Fad03(0.80), null, 1e-12);
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

    IAU::Refco($phpa, $tc, $rh, $wl, $refa, $refb);

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

    IAU::C2s($p, $theta, $phi);
    $this->assertEquals(-0.4636476090008061162, $theta, "theta", 1e-14);
    $this->assertEquals(0.2199879773954594463, $phi, "phi", 1e-14);
  }

  public function test_iauS2c() {
    $c = [];

    IAU::S2c(3.0123, -0.999, $c);

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

    IAU::Cpv($pv, $c);

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

    IAU::Apcg($date1, $date2, $ebpv, $ehp, $astrom);

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

    IAU::Bi00($dpsibi, $depsbi, $dra);

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

    IAU::Rx($phi, $r);

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

    IAU::Ry($theta, $r);

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

    IAU::Rz($psi, $r);

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

    IAU::Cr($r, $c);

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

    IAU::Bp00(2400000.5, 50123.9999, $rb, $rp, $rbp);

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

    IAU::Rxr($a, $b, $atb);

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

    IAU::Pmpx($rc, $dc, $pr, $pd, $px, $rv, $pmt, $pob, $pco);

    $this->assertEquals(0.2328137623960308440, $pco[0], "1", 1e-12);
    $this->assertEquals(0.6651097085397855317, $pco[1], "2", 1e-12);
    $this->assertEquals(0.7095257765896359847, $pco[2], "3", 1e-12);
  }

  public function test_iauLd() {
    $bm;
    $p  = [];
    $q  = [];
    $e  = [];
    $em;
    $dlim;
    $p1 = [];

    $bm   = 0.00028574;
    $p[0] = -0.763276255;
    $p[1] = -0.608633767;
    $p[2] = -0.216735543;
    $q[0] = -0.763276255;
    $q[1] = -0.608633767;
    $q[2] = -0.216735543;
    $e[0] = 0.76700421;
    $e[1] = 0.605629598;
    $e[2] = 0.211937094;
    $em   = 8.91276983;
    $dlim = 3e-10;

    IAU::Ld($bm, $p, $q, $e, $em, $dlim, $p1);

    $this->assertEquals(-0.7632762548968159627, $p1[0], "1", 1e-12);
    $this->assertEquals(-0.6086337670823762701, $p1[1], "2", 1e-12);
    $this->assertEquals(-0.2167355431320546947, $p1[2], "3", 1e-12);
  }

  public function test_iauPxp() {
    $a   = [];
    $b   = [];
    $axb = [];

    $a[0] = 2.0;
    $a[1] = 2.0;
    $a[2] = 3.0;

    $b[0] = 1.0;
    $b[1] = 3.0;
    $b[2] = 4.0;

    IAU::Pxp($a, $b, $axb);

    $this->assertEquals(-1.0, $axb[0], "1", 1e-12);
    $this->assertEquals(-5.0, $axb[1], "2", 1e-12);
    $this->assertEquals(4.0, $axb[2], "3", 1e-12);
  }

  public function test_iauLdsun() {
    $p  = [];
    $e  = [];
    $em;
    $p1 = [];

    $p[0] = -0.763276255;
    $p[1] = -0.608633767;
    $p[2] = -0.216735543;
    $e[0] = -0.973644023;
    $e[1] = -0.20925523;
    $e[2] = -0.0907169552;
    $em   = 0.999809214;

    IAU::Ldsun($p, $e, $em, $p1);

    $this->assertEquals(-0.7632762580731413169, $p1[0], "1", 1e-12);
    $this->assertEquals(-0.6086337635262647900, $p1[1], "2", 1e-12);
    $this->assertEquals(-0.2167355419322321302, $p1[2], "3", 1e-12);
  }

  public function test_iauRxp() {
    $r  = [];
    $p  = [];
    $rp = [];

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    $p[0] = 0.2;
    $p[1] = 1.5;
    $p[2] = 0.1;

    IAU::Rxp($r, $p, $rp);

    $this->assertEquals(5.1, $rp[0], "1", 1e-12);
    $this->assertEquals(3.9, $rp[1], "2", 1e-12);
    $this->assertEquals(7.1, $rp[2], "3", 1e-12);
  }

  public function test_iauAtciq() {
    $date1;
    $date2;
    $eo;
    $rc;
    $dc;
    $pr;
    $pd;
    $px;
    $rv;
    $ri;
    $di;
    $astrom = new iauASTROM();

    $date1 = 2456165.5;
    $date2 = 0.401182685;
    IAU::Apci13($date1, $date2, $astrom, $eo);
    $rc    = 2.71;
    $dc    = 0.174;
    $pr    = 1e-5;
    $pd    = 5e-6;
    $px    = 0.1;
    $rv    = 55.0;

    IAU::Atciq($rc, $dc, $pr, $pd, $px, $rv, $astrom, $ri, $di);

    $this->assertEquals(2.710121572969038991, $ri, "ri", 1e-12);
    $this->assertEquals(0.1729371367218230438, $di, "di", 1e-12);
  }

  public function test_iauApci13() {
    $date1;
    $date2;
    $eo;
    $astrom = new iauASTROM();

    $date1 = 2456165.5;
    $date2 = 0.401182685;

    IAU::Apci13($date1, $date2, $astrom, $eo);

    $this->assertEquals(12.65133794027378508, $astrom->pmt, "pmt", 1e-11);
    $this->assertEquals(0.9013108747340644755, $astrom->eb[0], "eb(1)", 1e-12);
    $this->assertEquals(-0.4174026640406119957, $astrom->eb[1], "eb(2)", 1e-12);
    $this->assertEquals(-0.1809822877867817771, $astrom->eb[2], "eb(3)", 1e-12);
    $this->assertEquals(0.8940025429255499549, $astrom->eh[0], "eh(1)", 1e-12);
    $this->assertEquals(-0.4110930268331896318, $astrom->eh[1], "eh(2)", 1e-12);
    $this->assertEquals(-0.1782189006019749850, $astrom->eh[2], "eh(3)", 1e-12);
    $this->assertEquals(1.010465295964664178, $astrom->em, "em", 1e-12);
    $this->assertEquals(0.4289638897157027528e-4, $astrom->v[0], "v(1)", 1e-16);
    $this->assertEquals(0.8115034002544663526e-4, $astrom->v[1], "v(2)", 1e-16);
    $this->assertEquals(0.3517555122593144633e-4, $astrom->v[2], "v(3)", 1e-16);
    $this->assertEquals(0.9999999951686013498, $astrom->bm1, "bm1", 1e-12);
    $this->assertEquals(0.9999992060376761710, $astrom->bpn[0][0], "bpn(1,1)",
            1e-12);
    $this->assertEquals(0.4124244860106037157e-7, $astrom->bpn[1][0],
            "bpn(2,1)", 1e-12);
    $this->assertEquals(0.1260128571051709670e-2, $astrom->bpn[2][0],
            "bpn(3,1)", 1e-12);
    $this->assertEquals(-0.1282291987222130690e-7, $astrom->bpn[0][1],
            "bpn(1,2)", 1e-12);
    $this->assertEquals(0.9999999997456835325, $astrom->bpn[1][1], "bpn(2,2)",
            1e-12);
    $this->assertEquals(-0.2255288829420524935e-4, $astrom->bpn[2][1],
            "bpn(3,2)", 1e-12);
    $this->assertEquals(-0.1260128571661374559e-2, $astrom->bpn[0][2],
            "bpn(1,3)", 1e-12);
    $this->assertEquals(0.2255285422953395494e-4, $astrom->bpn[1][2],
            "bpn(2,3)", 1e-12);
    $this->assertEquals(0.9999992057833604343, $astrom->bpn[2][2], "bpn(3,3)",
            1e-12);
    $this->assertEquals(-0.2900618712657375647e-2, $eo, "eo", 1e-12);
  }

  public function test_iauEpv00() {
    $pvh = [];
    $pvb = [];
    $j;

    $j = IAU::Epv00(2400000.5, 53411.52501161, $pvh, $pvb);

    $this->assertEquals(-0.7757238809297706813, $pvh[0][0], "ph(x)", 1e-14);
    $this->assertEquals(0.5598052241363340596, $pvh[0][1], "ph(y)", 1e-14);
    $this->assertEquals(0.2426998466481686993, $pvh[0][2], "ph(z)", 1e-14);

    $this->assertEquals(-0.1091891824147313846e-1, $pvh[1][0], "vh(x)", 1e-15);
    $this->assertEquals(-0.1247187268440845008e-1, $pvh[1][1], "vh(y)", 1e-15);
    $this->assertEquals(-0.5407569418065039061e-2, $pvh[1][2], "vh(z)", 1e-15);

    $this->assertEquals(-0.7714104440491111971, $pvb[0][0], "pb(x)", 1e-14);
    $this->assertEquals(0.5598412061824171323, $pvb[0][1], "pb(y)", 1e-14);
    $this->assertEquals(0.2425996277722452400, $pvb[0][2], "pb(z)", 1e-14);

    $this->assertEquals(-0.1091874268116823295e-1, $pvb[1][0], "vb(x)", 1e-15);
    $this->assertEquals(-0.1246525461732861538e-1, $pvb[1][1], "vb(y)", 1e-15);
    $this->assertEquals(-0.5404773180966231279e-2, $pvb[1][2], "vb(z)", 1e-15);

    $this->assertEquals(0, $j, "j");
  }

  public function test_iauPnm06a() {
    $rbpn = [];

    IAU::Pnm06a(2400000.5, 50123.9999, $rbpn);

    $this->assertEquals(0.9999995832794205484, $rbpn[0][0], "11", 1e-12);
    $this->assertEquals(0.8372382772630962111e-3, $rbpn[0][1], "12", 1e-14);
    $this->assertEquals(0.3639684771140623099e-3, $rbpn[0][2], "13", 1e-14);

    $this->assertEquals(-0.8372533744743683605e-3, $rbpn[1][0], "21", 1e-14);
    $this->assertEquals(0.9999996486492861646, $rbpn[1][1], "22", 1e-12);
    $this->assertEquals(0.4132905944611019498e-4, $rbpn[1][2], "23", 1e-14);

    $this->assertEquals(-0.3639337469629464969e-3, $rbpn[2][0], "31", 1e-14);
    $this->assertEquals(-0.4163377605910663999e-4, $rbpn[2][1], "32", 1e-14);
    $this->assertEquals(0.9999999329094260057, $rbpn[2][2], "33", 1e-12);
  }

  public function test_iauPfw06() {
    $gamb;
    $phib;
    $psib;
    $epsa;

    IAU::Pfw06(2400000.5, 50123.9999, $gamb, $phib, $psib, $epsa);

    $this->assertEquals(-0.2243387670997995690e-5, $gamb, "gamb", 1e-16);
    $this->assertEquals(0.4091014602391312808, $phib, "phib", 1e-12);
    $this->assertEquals(-0.9501954178013031895e-3, $psib, "psib", 1e-14);
    $this->assertEquals(0.4091014316587367491, $epsa, "epsa", 1e-12);
  }

  public function test_iauFw2m() {
    $gamb;
    $phib;
    $psi;
    $eps;
    $r = [];

    $gamb = -0.2243387670997992368e-5;
    $phib = 0.4091014602391312982;
    $psi  = -0.9501954178013015092e-3;
    $eps  = 0.4091014316587367472;

    IAU::Fw2m($gamb, $phib, $psi, $eps, $r);

    $this->assertEquals(0.9999995505176007047, $r[0][0], "11", 1e-12);
    $this->assertEquals(0.8695404617348192957e-3, $r[0][1], "12", 1e-12);
    $this->assertEquals(0.3779735201865582571e-3, $r[0][2], "13", 1e-12);

    $this->assertEquals(-0.8695404723772016038e-3, $r[1][0], "21", 1e-12);
    $this->assertEquals(0.9999996219496027161, $r[1][1], "22", 1e-12);
    $this->assertEquals(-0.1361752496887100026e-6, $r[1][2], "23", 1e-12);

    $this->assertEquals(-0.3779734957034082790e-3, $r[2][0], "31", 1e-12);
    $this->assertEquals(-0.1924880848087615651e-6, $r[2][1], "32", 1e-12);
    $this->assertEquals(0.9999999285679971958, $r[2][2], "33", 1e-12);
  }

  public function test_iauBpn2xy() {
    $rbpn = [];
    $x;
    $y;

    $rbpn[0][0] = 9.999962358680738e-1;
    $rbpn[0][1] = -2.516417057665452e-3;
    $rbpn[0][2] = -1.093569785342370e-3;

    $rbpn[1][0] = 2.516462370370876e-3;
    $rbpn[1][1] = 9.999968329010883e-1;
    $rbpn[1][2] = 4.006159587358310e-5;

    $rbpn[2][0] = 1.093465510215479e-3;
    $rbpn[2][1] = -4.281337229063151e-5;
    $rbpn[2][2] = 9.999994012499173e-1;

    IAU::Bpn2xy($rbpn, $x, $y);

    $this->assertEquals(1.093465510215479e-3, $x, "x", 1e-12);
    $this->assertEquals(-4.281337229063151e-5, $y, "y", 1e-12);
  }

  public function test_iauS06() {
    $x;
    $y;
    $s;

    $x = 0.5791308486706011000e-3;
    $y = 0.4020579816732961219e-4;

    $s = IAU::S06(2400000.5, 53736.0, $x, $y);

    $this->assertEquals(-0.1220032213076463117e-7, $s, null, 1e-18);
  }

  public function test_iauApci() {
    $date1;
    $date2;
    $ebpv   = [];
    $ehp    = [];
    $x;
    $y;
    $s;
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
    $x          = 0.0013122272;
    $y          = -2.92808623e-5;
    $s          = 3.05749468e-8;

    IAU::Apci($date1, $date2, $ebpv, $ehp, $x, $y, $s, $astrom);

    $this->assertEquals(12.65133794027378508, $astrom->pmt, "pmt", 1e-11);
    $this->assertEquals(0.901310875, $astrom->eb[0], "eb(1)", 1e-12);
    $this->assertEquals(-0.417402664, $astrom->eb[1], "eb(2)", 1e-12);
    $this->assertEquals(-0.180982288, $astrom->eb[2], "eb(3)", 1e-12);
    $this->assertEquals(0.8940025429324143045, $astrom->eh[0], "eh(1)", 1e-12);
    $this->assertEquals(-0.4110930268679817955, $astrom->eh[1], "eh(2)", 1e-12);
    $this->assertEquals(-0.1782189004872870264, $astrom->eh[2], "eh(3)", 1e-12);
    $this->assertEquals(1.010465295811013146, $astrom->em, "em", 1e-12);
    $this->assertEquals(0.4289638897813379954e-4, $astrom->v[0], "v(1)", 1e-16);
    $this->assertEquals(0.8115034021720941898e-4, $astrom->v[1], "v(2)", 1e-16);
    $this->assertEquals(0.3517555123437237778e-4, $astrom->v[2], "v(3)", 1e-16);
    $this->assertEquals(0.9999999951686013336, $astrom->bm1, "bm1", 1e-12);
    $this->assertEquals(0.9999991390295159156, $astrom->bpn[0][0], "bpn(1,1)",
            1e-12);
    $this->assertEquals(0.4978650072505016932e-7, $astrom->bpn[1][0],
            "bpn(2,1)", 1e-12);
    $this->assertEquals(0.1312227200000000000e-2, $astrom->bpn[2][0],
            "bpn(3,1)", 1e-12);
    $this->assertEquals(-0.1136336653771609630e-7, $astrom->bpn[0][1],
            "bpn(1,2)", 1e-12);
    $this->assertEquals(0.9999999995713154868, $astrom->bpn[1][1], "bpn(2,2)",
            1e-12);
    $this->assertEquals(-0.2928086230000000000e-4, $astrom->bpn[2][1],
            "bpn(3,2)", 1e-12);
    $this->assertEquals(-0.1312227200895260194e-2, $astrom->bpn[0][2],
            "bpn(1,3)", 1e-12);
    $this->assertEquals(0.2928082217872315680e-4, $astrom->bpn[1][2],
            "bpn(2,3)", 1e-12);
    $this->assertEquals(0.9999991386008323373, $astrom->bpn[2][2], "bpn(3,3)",
            1e-12);
  }

  public function test_iauC2ixys() {
    $x;
    $y;
    $s;
    $rc2i = [];

    $x = 0.5791308486706011000e-3;
    $y = 0.4020579816732961219e-4;
    $s = -0.1220040848472271978e-7;

    IAU::C2ixys($x, $y, $s, $rc2i);

    $this->assertEquals(0.9999998323037157138, $rc2i[0][0], "11", 1e-12);
    $this->assertEquals(0.5581984869168499149e-9, $rc2i[0][1], "12", 1e-12);
    $this->assertEquals(-0.5791308491611282180e-3, $rc2i[0][2], "13", 1e-12);

    $this->assertEquals(-0.2384261642670440317e-7, $rc2i[1][0], "21", 1e-12);
    $this->assertEquals(0.9999999991917468964, $rc2i[1][1], "22", 1e-12);
    $this->assertEquals(-0.4020579110169668931e-4, $rc2i[1][2], "23", 1e-12);

    $this->assertEquals(0.5791308486706011000e-3, $rc2i[2][0], "31", 1e-12);
    $this->assertEquals(0.4020579816732961219e-4, $rc2i[2][1], "32", 1e-12);
    $this->assertEquals(0.9999998314954627590, $rc2i[2][2], "33", 1e-12);
  }

  public function test_iauEors() {
    $rnpb = [];
    $s;
    $eo;

    $rnpb[0][0] = 0.9999989440476103608;
    $rnpb[0][1] = -0.1332881761240011518e-2;
    $rnpb[0][2] = -0.5790767434730085097e-3;

    $rnpb[1][0] = 0.1332858254308954453e-2;
    $rnpb[1][1] = 0.9999991109044505944;
    $rnpb[1][2] = -0.4097782710401555759e-4;

    $rnpb[2][0] = 0.5791308472168153320e-3;
    $rnpb[2][1] = 0.4020595661593994396e-4;
    $rnpb[2][2] = 0.9999998314954572365;

    $s = -0.1220040848472271978e-7;

    $eo = IAU::Eors($rnpb, $s);

    $this->assertEquals(-0.1332882715130744606e-2, $eo, null, 1e-14);
  }

  public function test_iauJd2cal() {
    $dj1;
    $dj2;
    $fd;
    $iy;
    $im;
    $id;
    $j;

    $dj1 = 2400000.5;
    $dj2 = 50123.9999;

    $j = IAU::Jd2cal($dj1, $dj2, $iy, $im, $id, $fd);

    $this->assertEquals(1996, $iy, "y");
    $this->assertEquals(2, $im, "m");
    $this->assertEquals(10, $id, "d");
    $this->assertEquals(0.9999, $fd, "fd", 1e-7);
    $this->assertEquals(0, $j, "j");


    // // //

    /**
     * The Jd2cal function relies heavily on type safe features of the C
     * language, primarilly implicit integer division. Becasue PHP is not a type
     * safe language, and the method was modified to simulate these features,
     * more extensive testing is provided to enxure the algorithm performs as
     * expected.
     */
    $tests = [
        [2440624, 1970, 2, 6, 0.5],
        [2441624, 1972, 11, 2, 0.5],
        [2441624.343200, 1972, 11, 2, 0.8432],
        [2441624.345420, 1972, 11, 02, 0.84542],
        [2458375.092840, 2018, 9, 13, 0.59284],
        [2453750.5 + 0.892100694, 2006, 1, 15, 0.8921006],
        [2453752, 2006, 1, 16, 0.5],
    ];

    foreach ($tests as $test) {
      $j = IAU::Jd2cal($test[0], 0, $iy, $im, $id, $fd);

      $this->assertEquals($test[1], $iy, "{$test[0]} y");
      $this->assertEquals($test[2], $im, "{$test[0]} m");
      $this->assertEquals($test[3], $id, "{$test[0]} d");
      $this->assertEquals($test[4], $fd, "{$test[0]} fd", 1e-7);
      $this->assertEquals(0, $j, "{$test[0]} j");
    }
  }

  public function test_Cal2jd() {
    $j;
    $djm0;
    $djm;

    $j = IAU::Cal2jd(2003, 06, 01, $djm0, $djm);

    $this->assertEquals(2400000.5, $djm0, "djm0", 0.0);
    $this->assertEquals(52791.0, $djm, "djm", 0.0);

    $this->assertEquals(0, $j, "j");

    // // //

    /**
     * The Jd2cal function relies heavily on type safe features of the C
     * language, primarilly implicit integer division. Becasue PHP is not a type
     * safe language, and the method was modified to simulate these features,
     * more extensive testing is provided to enxure the algorithm performs as
     * expected.
     */
    $tests = [
        [2440623.5, 1970, 2, 6],
        [2441624.5, 1972, 11, 3],
        [2441623.5, 1972, 11, 2],
        [2441623.5, 1972, 11, 2],
        [2458374.5, 2018, 9, 13],
    ];

    foreach ($tests as $test) {
      $j = IAU::Cal2jd($test[1], $test[2], $test[3], $djm0, $djm);

      $this->assertEquals(2400000.5, $djm0, "{$test[0]} djm0", 0.0);
      $this->assertEquals($test[0] - 2400000.5, $djm, "{$test[0]} djm", 0.0);

      $this->assertEquals(0, $j, "{$test[0]} j");
    }
  }

  public function test_iauTaitt() {
    $t1;
    $t2;
    $j;

    $j = IAU::Taitt(2453750.5, 0.892482639, $t1, $t2);

    $this->assertEquals(2453750.5, $t1, "t1", 1e-6);
    $this->assertEquals(0.892855139, $t2, "t2", 1e-12);
    $this->assertEquals(0, $j, "j");
  }

  public function test_iauDat() {
    $j;
    $deltat;

    $j = IAU::Dat(2003, 6, 1, 0.0, $deltat);

    $this->assertEquals(32.0, $deltat, "d1", 0.0);
    $this->assertEquals(0, $j, "j1");

    $j = IAU::Dat(2008, 1, 17, 0.0, $deltat);

    $this->assertEquals(33.0, $deltat, "d2", 0.0);
    $this->assertEquals(0, $j, "j2");

    $j = IAU::Dat(2015, 9, 1, 0.0, $deltat);

    $this->assertEquals(36.0, $deltat, "d3", 0.0);
    $this->assertEquals(0, $j, "j3");
  }

  public function test_iauUtctai() {
    $u1;
    $u2;
    $j;

    $j = IAU::Utctai(2453750.5, 0.892100694, $u1, $u2);

    $this->assertEquals(2453750.5, $u1, "u1", 1e-6);
    $this->assertEquals(0.8924826384444444444, $u2, "u2", 1e-12);
    $this->assertEquals(0, $j, "j");
  }

  public function test_iauUtcut1() {
    $u1;
    $u2;
    $j;

    $j = IAU::Utcut1(2453750.5, 0.892100694, 0.3341, $u1, $u2);

    $this->assertEquals(2453750.5, $u1, "u1", 1e-6);
    $this->assertEquals(0.8921045608981481481, $u2, "u2", 1e-12);
    $this->assertEquals(0, $j, "j");
  }

  public function test_iauTaiut1() {
    $u1;
    $u2;
    $j;

    $j = IAU::Taiut1(2453750.5, 0.892482639, -32.6659, $u1, $u2);

    $this->assertEquals(2453750.5, $u1, "u1", 1e-6);
    $this->assertEquals(0.8921045614537037037, $u2, "u2", 1e-12);
    $this->assertEquals(0, $j, "j");
  }

  public function test_iauSp00() {
    $this->assertEquals(
            -0.6216698469981019309e-11, IAU::Sp00(2400000.5, 52541.0), 1e-12);
  }

  public function test_iauEform() {
    $j;
    $a;
    $f;

    $j = IAU::Eform(iauRefEllips::None(), $a, $f);

    $this->assertEquals(-1, $j, "j0");

    $j = IAU::Eform(iauRefEllips::WGS84(), $a, $f);

    $this->assertEquals(0, $j, "j1");
    $this->assertEquals(6378137.0, $a, "a1", 1e-10);
    $this->assertEquals(0.0033528106647474807, $f, "f1", 1e-18);

    $j = IAU::Eform(iauRefEllips::GRS80(), $a, $f);

    $this->assertEquals(0, $j, "j2");
    $this->assertEquals(6378137.0, $a, "a2", 1e-10);
    $this->assertEquals(0.0033528106811823189, $f, "f2", 1e-18);

    $j = IAU::Eform(iauRefEllips::WGS72(), $a, $f);

    $this->assertEquals(0, $j, "j2");
    $this->assertEquals(6378135.0, $a, "a3", 1e-10);
    $this->assertEquals(0.0033527794541675049, $f, "f3", 1e-18);

    $j = IAU::Eform(iauRefEllips::None(), $a, $f);
    $this->assertEquals(-1, $j, "j3");
  }

  public function test_iauGd2gce() {
    $j;
    $a   = 6378136.0;
    $f   = 0.0033528;
    $e   = 3.1;
    $p   = -0.5;
    $h   = 2500.0;
    $xyz = [];

    $j = IAU::Gd2gce($a, $f, $e, $p, $h, $xyz);

    $this->assertEquals(0, $j, "j");
    $this->assertEquals(-5598999.6665116328, $xyz[0], "0", 1e-7);
    $this->assertEquals(233011.63514630572, $xyz[1], "1", 1e-7);
    $this->assertEquals(-3040909.0517314132, $xyz[2], "2", 1e-7);
  }

  public function test_iauGd2gc() {
    $j;
    $e   = 3.1;
    $p   = -0.5;
    $h   = 2500.0;
    $xyz = [];

    $j = IAU::Gd2gc(iauRefEllips::None(), $e, $p, $h, $xyz);

    $this->assertEquals(-1, $j, "j0");

    $j = IAU::Gd2gc(iauRefEllips::WGS84(), $e, $p, $h, $xyz);

    $this->assertEquals(0, $j, "j1");
    $this->assertEquals(-5599000.5577049947, $xyz[0], "0/1", 1e-7);
    $this->assertEquals(233011.67223479203, $xyz[1], "1/1", 1e-7);
    $this->assertEquals(-3040909.4706983363, $xyz[2], "2/1", 1e-7);

    $j = IAU::Gd2gc(iauRefEllips::GRS80(), $e, $p, $h, $xyz);

    $this->assertEquals(0, $j, "j2");
    $this->assertEquals(-5599000.5577260984, $xyz[0], "0/2", 1e-7);
    $this->assertEquals(233011.6722356703, $xyz[1], "1/2", 1e-7);
    $this->assertEquals(-3040909.4706095476, $xyz[2], "2/2", 1e-7);

    $j = IAU::Gd2gc(iauRefEllips::WGS72(), $e, $p, $h, $xyz);

    $this->assertEquals(0, $j, "j3");
    $this->assertEquals(-5598998.7626301490, $xyz[0], "0/3", 1e-7);
    $this->assertEquals(233011.5975297822, $xyz[1], "1/3", 1e-7);
    $this->assertEquals(-3040908.6861467111, $xyz[2], "2/3", 1e-7);

    $j = IAU::Gd2gc(iauRefEllips::None(), $e, $p, $h, $xyz);

    $this->assertEquals($j, -1, "j4");
  }

  public function test_iauPom00() {
    $xp;
    $yp;
    $sp;
    $rpom = [];

    $xp = 2.55060238e-7;
    $yp = 1.860359247e-6;
    $sp = -0.1367174580728891460e-10;

    IAU::Pom00($xp, $yp, $sp, $rpom);

    $this->assertEquals(0.9999999999999674721, $rpom[0][0], "11", 1e-12);
    $this->assertEquals(-0.1367174580728846989e-10, $rpom[0][1], "12", 1e-16);
    $this->assertEquals(0.2550602379999972345e-6, $rpom[0][2], "13", 1e-16);

    $this->assertEquals(0.1414624947957029801e-10, $rpom[1][0], "21", 1e-16);
    $this->assertEquals(0.9999999999982695317, $rpom[1][1], "22", 1e-12);
    $this->assertEquals(-0.1860359246998866389e-5, $rpom[1][2], "23", 1e-16);

    $this->assertEquals(-0.2550602379741215021e-6, $rpom[2][0], "31", 1e-16);
    $this->assertEquals(0.1860359247002414021e-5, $rpom[2][1], "32", 1e-16);
    $this->assertEquals(0.9999999999982370039, $rpom[2][2], "33", 1e-12);
  }

  public function test_iauTr() {
    $r  = [];
    $rt = [];

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    IAU::Tr($r, $rt);

    $this->assertEquals(2.0, $rt[0][0], "11", 0.0);
    $this->assertEquals(3.0, $rt[0][1], "12", 0.0);
    $this->assertEquals(3.0, $rt[0][2], "13", 0.0);

    $this->assertEquals(3.0, $rt[1][0], "21", 0.0);
    $this->assertEquals(2.0, $rt[1][1], "22", 0.0);
    $this->assertEquals(4.0, $rt[1][2], "23", 0.0);

    $this->assertEquals(2.0, $rt[2][0], "31", 0.0);
    $this->assertEquals(3.0, $rt[2][1], "32", 0.0);
    $this->assertEquals(5.0, $rt[2][2], "33", 0.0);
  }

  public function test_iauTrxp() {
    $r   = [];
    $p   = [];
    $trp = [];

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    $p[0] = 0.2;
    $p[1] = 1.5;
    $p[2] = 0.1;

    IAU::Trxp($r, $p, $trp);

    $this->assertEquals(5.2, $trp[0], "1", 1e-12);
    $this->assertEquals(4.0, $trp[1], "2", 1e-12);
    $this->assertEquals(5.4, $trp[2], "3", 1e-12);
  }

  public function test_iauPvtob() {
    $elong;
    $phi;
    $hm;
    $xp;
    $yp;
    $sp;
    $theta;
    $pv = [];

    $elong = 2.0;
    $phi   = 0.5;
    $hm    = 3000.0;
    $xp    = 1e-6;
    $yp    = -0.5e-6;
    $sp    = 1e-8;
    $theta = 5.0;

    IAU::Pvtob($elong, $phi, $hm, $xp, $yp, $sp, $theta, $pv);

    $this->assertEquals(4225081.367071159207, $pv[0][0], "p(1)", 1e-5);
    $this->assertEquals(3681943.215856198144, $pv[0][1], "p(2)", 1e-5);
    $this->assertEquals(3041149.399241260785, $pv[0][2], "p(3)", 1e-5);
    $this->assertEquals(-268.4915389365998787, $pv[1][0], "v(1)", 1e-9);
    $this->assertEquals(308.0977983288903123, $pv[1][1], "v(2)", 1e-9);
    $this->assertEquals(0, $pv[1][2], "v(3)", 0);
  }

  public function test_iauTrxpv() {
    $r    = [];
    $pv   = [];
    $trpv = [[], []];

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    $pv[0][0] = 0.2;
    $pv[0][1] = 1.5;
    $pv[0][2] = 0.1;

    $pv[1][0] = 1.5;
    $pv[1][1] = 0.2;
    $pv[1][2] = 0.1;

    IAU::Trxpv($r, $pv, $trpv);

    $this->assertEquals(5.2, $trpv[0][0], "p1", 1e-12);
    $this->assertEquals(4.0, $trpv[0][1], "p1", 1e-12);
    $this->assertEquals(5.4, $trpv[0][2], "p1", 1e-12);

    $this->assertEquals(3.9, $trpv[1][0], "v1", 1e-12);
    $this->assertEquals(5.3, $trpv[1][1], "v2", 1e-12);
    $this->assertEquals(4.1, $trpv[1][2], "v3", 1e-12);
  }

  public function test_Rxp() {
    $r  = [];
    $p  = [];
    $rp = [];

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    $p[0] = 0.2;
    $p[1] = 1.5;
    $p[2] = 0.1;

    IAU::Rxp($r, $p, $rp);

    $this->assertEquals(5.1, $rp[0], "1", 1e-12);
    $this->assertEquals(3.9, $rp[1], "2", 1e-12);
    $this->assertEquals(7.1, $rp[2], "3", 1e-12);
  }

  public function test_iauRxpv() {
    $r   = [];
    $p   = [];
    $rpv = [[], []];

    $r[0][0] = 2.0;
    $r[0][1] = 3.0;
    $r[0][2] = 2.0;

    $r[1][0] = 3.0;
    $r[1][1] = 2.0;
    $r[1][2] = 3.0;

    $r[2][0] = 3.0;
    $r[2][1] = 4.0;
    $r[2][2] = 5.0;

    $pv[0][0] = 0.2;
    $pv[0][1] = 1.5;
    $pv[0][2] = 0.1;

    $pv[1][0] = 1.5;
    $pv[1][1] = 0.2;
    $pv[1][2] = 0.1;

    IAU::Rxpv($r, $pv, $rpv);

    $this->assertEquals(5.1, $rpv[0][0], "11", 1e-12);
    $this->assertEquals(3.8, $rpv[1][0], "12", 1e-12);

    $this->assertEquals(3.9, $rpv[0][1], "21", 1e-12);
    $this->assertEquals(5.2, $rpv[1][1], "22", 1e-12);

    $this->assertEquals(7.1, $rpv[0][2], "31", 1e-12);
    $this->assertEquals(5.8, $rpv[1][2], "32", 1e-12);
  }

  public function test_iauApco() {
    $date1;
    $date2;
    $ebpv   = [[], []];
    $ehp    = [[], []];
    $x;
    $y;
    $s;
    $theta;
    $elong;
    $phi;
    $hm;
    $xp;
    $yp;
    $sp;
    $refa;
    $refb;
    $astrom = new iauASTROM();


    $date1      = 2456384.5;
    $date2      = 0.970031644;
    $ebpv[0][0] = -0.974170438;
    $ebpv[0][1] = -0.211520082;
    $ebpv[0][2] = -0.0917583024;
    $ebpv[1][0] = 0.00364365824;
    $ebpv[1][1] = -0.0154287319;
    $ebpv[1][2] = -0.00668922024;
    $ehp[0]     = -0.973458265;
    $ehp[1]     = -0.209215307;
    $ehp[2]     = -0.0906996477;
    $x          = 0.0013122272;
    $y          = -2.92808623e-5;
    $s          = 3.05749468e-8;
    $theta      = 3.14540971;
    $elong      = -0.527800806;
    $phi        = -1.2345856;
    $hm         = 2738.0;
    $xp         = 2.47230737e-7;
    $yp         = 1.82640464e-6;
    $sp         = -3.01974337e-11;
    $refa       = 0.000201418779;
    $refb       = -2.36140831e-7;

    IAU::Apco($date1, $date2, $ebpv, $ehp, $x, $y, $s, $theta, $elong, $phi,
            $hm, $xp, $yp, $sp, $refa, $refb, $astrom);

    $this->assertEquals(13.25248468622587269, $astrom->pmt, "pmt", 1e-11);
    $this->assertEquals(-0.9741827110630897003, $astrom->eb[0], "eb(1)", 1e-12);
    $this->assertEquals(-0.2115130190135014340, $astrom->eb[1], "eb(2)", 1e-12);
    $this->assertEquals(-0.09179840186968295686, $astrom->eb[2], "eb(3)", 1e-12);
    $this->assertEquals(-0.9736425571689670428, $astrom->eh[0], "eh(1)", 1e-12);
    $this->assertEquals(-0.2092452125848862201, $astrom->eh[1], "eh(2)", 1e-12);
    $this->assertEquals(-0.09075578152261439954, $astrom->eh[2], "eh(3)", 1e-12);
    $this->assertEquals(0.9998233241710617934, $astrom->em, "em", 1e-12);
    $this->assertEquals(0.2078704985147609823e-4, $astrom->v[0], "v(1)", 1e-16);
    $this->assertEquals(-0.8955360074407552709e-4, $astrom->v[1], "v(2)", 1e-16);
    $this->assertEquals(-0.3863338980073114703e-4, $astrom->v[2], "v(3)", 1e-16);
    $this->assertEquals(0.9999999950277561600, $astrom->bm1, "bm1", 1e-12);
    $this->assertEquals(0.9999991390295159156, $astrom->bpn[0][0], "bpn(1,1)",
            1e-12);
    $this->assertEquals(0.4978650072505016932e-7, $astrom->bpn[1][0],
            "bpn(2,1)", 1e-12);
    $this->assertEquals(0.1312227200000000000e-2, $astrom->bpn[2][0],
            "bpn(3,1)", 1e-12);
    $this->assertEquals(-0.1136336653771609630e-7, $astrom->bpn[0][1],
            "bpn(1,2)", 1e-12);
    $this->assertEquals(0.9999999995713154868, $astrom->bpn[1][1], "bpn(2,2)",
            1e-12);
    $this->assertEquals(-0.2928086230000000000e-4, $astrom->bpn[2][1],
            "bpn(3,2)", 1e-12);
    $this->assertEquals(-0.1312227200895260194e-2, $astrom->bpn[0][2],
            "bpn(1,3)", 1e-12);
    $this->assertEquals(0.2928082217872315680e-4, $astrom->bpn[1][2],
            "bpn(2,3)", 1e-12);
    $this->assertEquals(0.9999991386008323373, $astrom->bpn[2][2], "bpn(3,3)",
            1e-12);
    $this->assertEquals(-0.5278008060301974337, $astrom->along, "along", 1e-12);
    $this->assertEquals(0.1133427418174939329e-5, $astrom->xpl, "xpl", 1e-17);
    $this->assertEquals(0.1453347595745898629e-5, $astrom->ypl, "ypl", 1e-17);
    $this->assertEquals(-0.9440115679003211329, $astrom->sphi, "sphi", 1e-12);
    $this->assertEquals(0.3299123514971474711, $astrom->cphi, "cphi", 1e-12);
    $this->assertEquals(0, $astrom->diurab, "diurab", 0);
    $this->assertEquals(2.617608903969802566, $astrom->eral, "eral", 1e-12);
    $this->assertEquals(0.2014187790000000000e-3, $astrom->refa, "refa", 1e-15);
    $this->assertEquals(-0.2361408310000000000e-6, $astrom->refb, "refb", 1e-18);
  }

  public function test_iauApco13() {
    $utc1;
    $utc2;
    $dut1;
    $elong;
    $phi;
    $hm;
    $xp;
    $yp;
    $phpa;
    $tc;
    $rh;
    $wl;
    $eo;
    $astrom = new iauASTROM();
    $j;

    $utc1  = 2456384.5;
    $utc2  = 0.969254051;
    $dut1  = 0.1550675;
    $elong = -0.527800806;
    $phi   = -1.2345856;
    $hm    = 2738.0;
    $xp    = 2.47230737e-7;
    $yp    = 1.82640464e-6;
    $phpa  = 731.0;
    $tc    = 12.8;
    $rh    = 0.59;
    $wl    = 0.55;

    $j = IAU::Apco13($utc1, $utc2, $dut1, $elong, $phi, $hm, $xp, $yp, $phpa,
                    $tc, $rh, $wl, $astrom, $eo);

    $this->assertEquals(13.25248468622475727, $astrom->pmt, "pmt", 1e-11);
    $this->assertEquals(-0.9741827107321449445, $astrom->eb[0], "eb(1)", 1e-12);
    $this->assertEquals(-0.2115130190489386190, $astrom->eb[1], "eb(2)", 1e-12);
    $this->assertEquals(-0.09179840189515518726, $astrom->eb[2], "eb(3)", 1e-12);
    $this->assertEquals(-0.9736425572586866640, $astrom->eh[0], "eh(1)", 1e-12);
    $this->assertEquals(-0.2092452121602867431, $astrom->eh[1], "eh(2)", 1e-12);
    $this->assertEquals(-0.09075578153903832650, $astrom->eh[2], "eh(3)", 1e-12);
    $this->assertEquals(0.9998233240914558422, $astrom->em, "em", 1e-12);
    $this->assertEquals(0.2078704986751370303e-4, $astrom->v[0], "v(1)", 1e-16);
    $this->assertEquals(-0.8955360100494469232e-4, $astrom->v[1], "v(2)", 1e-16);
    $this->assertEquals(-0.3863338978840051024e-4, $astrom->v[2], "v(3)", 1e-16);
    $this->assertEquals(0.9999999950277561368, $astrom->bm1, "bm1", 1e-12);
    $this->assertEquals(0.9999991390295147999, $astrom->bpn[0][0], "bpn(1,1)",
            1e-12);
    $this->assertEquals(0.4978650075315529277e-7, $astrom->bpn[1][0],
            "bpn(2,1)", 1e-12);
    $this->assertEquals(0.001312227200850293372, $astrom->bpn[2][0], "bpn(3,1)",
            1e-12);
    $this->assertEquals(-0.1136336652812486604e-7, $astrom->bpn[0][1],
            "bpn(1,2)", 1e-12);
    $this->assertEquals(0.9999999995713154865, $astrom->bpn[1][1], "bpn(2,2)",
            1e-12);
    $this->assertEquals(-0.2928086230975367296e-4, $astrom->bpn[2][1],
            "bpn(3,2)", 1e-12);
    $this->assertEquals(-0.001312227201745553566, $astrom->bpn[0][2],
            "bpn(1,3)", 1e-12);
    $this->assertEquals(0.2928082218847679162e-4, $astrom->bpn[1][2],
            "bpn(2,3)", 1e-12);
    $this->assertEquals(0.9999991386008312212, $astrom->bpn[2][2], "bpn(3,3)",
            1e-12);
    $this->assertEquals(-0.5278008060301974337, $astrom->along, "along", 1e-12);
    $this->assertEquals(0.1133427418174939329e-5, $astrom->xpl, "xpl", 1e-17);
    $this->assertEquals(0.1453347595745898629e-5, $astrom->ypl, "ypl", 1e-17);
    $this->assertEquals(-0.9440115679003211329, $astrom->sphi, "sphi", 1e-12);
    $this->assertEquals(0.3299123514971474711, $astrom->cphi, "cphi", 1e-12);
    $this->assertEquals(0, $astrom->diurab, "diurab", 0);
    $this->assertEquals(2.617608909189066140, $astrom->eral, "eral", 1e-12);
    $this->assertEquals(0.2014187785940396921e-3, $astrom->refa, "refa", 1e-15);
    $this->assertEquals(-0.2361408314943696227e-6, $astrom->refb, "refb", 1e-18);
    $this->assertEquals(-0.003020548354802412839, $eo, "eo", 1e-14);
    $this->assertEquals(0, $j, "j");
  }

  public function test_iauAtioq() {
    $utc1;
    $utc2;
    $dut1;
    $elong;
    $phi;
    $hm;
    $xp;
    $yp;
    $phpa;
    $tc;
    $rh;
    $wl;
    $ri;
    $di;
    $aob;
    $zob;
    $hob;
    $dob;
    $rob;
    $astrom = new iauASTROM();

    $utc1  = 2456384.5;
    $utc2  = 0.969254051;
    $dut1  = 0.1550675;
    $elong = -0.527800806;
    $phi   = -1.2345856;
    $hm    = 2738.0;
    $xp    = 2.47230737e-7;
    $yp    = 1.82640464e-6;
    $phpa  = 731.0;
    $tc    = 12.8;
    $rh    = 0.59;
    $wl    = 0.55;
    IAU::Apio13($utc1, $utc2, $dut1, $elong, $phi, $hm, $xp, $yp, $phpa, $tc,
            $rh, $wl, $astrom);
    $ri    = 2.710121572969038991;
    $di    = 0.1729371367218230438;

    IAU::Atioq($ri, $di, $astrom, $aob, $zob, $hob, $dob, $rob);

    $this->assertEquals(0.09233952224794989993, $aob, "aob", 1e-12);
    $this->assertEquals(1.407758704513722461, $zob, "zob", 1e-12);
    $this->assertEquals(-0.09247619879782006106, $hob, "hob", 1e-12);
    $this->assertEquals(0.1717653435758265198, $dob, "dob", 1e-12);
    $this->assertEquals(2.710085107986886201, $rob, "rob", 1e-12);
  }

  public function test_iauApio() {
    $date1;
    $date2;
    $ebpv   = [];
    $ehp    = [];
    $x;
    $y;
    $s;
    $theta;
    $elong;
    $phi;
    $hm;
    $xp;
    $yp;
    $sp;
    $refa;
    $refb;
    $astrom = new iauASTROM();

    $date1      = 2456384.5;
    $date2      = 0.970031644;
    $ebpv[0][0] = -0.974170438;
    $ebpv[0][1] = -0.211520082;
    $ebpv[0][2] = -0.0917583024;
    $ebpv[1][0] = 0.00364365824;
    $ebpv[1][1] = -0.0154287319;
    $ebpv[1][2] = -0.00668922024;
    $ehp[0]     = -0.973458265;
    $ehp[1]     = -0.209215307;
    $ehp[2]     = -0.0906996477;
    $x          = 0.0013122272;
    $y          = -2.92808623e-5;
    $s          = 3.05749468e-8;
    $theta      = 3.14540971;
    $elong      = -0.527800806;
    $phi        = -1.2345856;
    $hm         = 2738.0;
    $xp         = 2.47230737e-7;
    $yp         = 1.82640464e-6;
    $sp         = -3.01974337e-11;
    $refa       = 0.000201418779;
    $refb       = -2.36140831e-7;

    IAU::Apco($date1, $date2, $ebpv, $ehp, $x, $y, $s, $theta, $elong, $phi,
            $hm, $xp, $yp, $sp, $refa, $refb, $astrom);

    $this->assertEquals(13.25248468622587269, $astrom->pmt, "pmt", 1e-11);
    $this->assertEquals(-0.9741827110630897003, $astrom->eb[0], "eb(1)", 1e-12);
    $this->assertEquals(-0.2115130190135014340, $astrom->eb[1], "eb(2)", 1e-12);
    $this->assertEquals(-0.09179840186968295686, $astrom->eb[2], "eb(3)", 1e-12);
    $this->assertEquals(-0.9736425571689670428, $astrom->eh[0], "eh(1)", 1e-12);
    $this->assertEquals(-0.2092452125848862201, $astrom->eh[1], "eh(2)", 1e-12);
    $this->assertEquals(-0.09075578152261439954, $astrom->eh[2], "eh(3)", 1e-12);
    $this->assertEquals(0.9998233241710617934, $astrom->em, "em", 1e-12);
    $this->assertEquals(0.2078704985147609823e-4, $astrom->v[0], "v(1)", 1e-16);
    $this->assertEquals(-0.8955360074407552709e-4, $astrom->v[1], "v(2)", 1e-16);
    $this->assertEquals(-0.3863338980073114703e-4, $astrom->v[2], "v(3)", 1e-16);
    $this->assertEquals(0.9999999950277561600, $astrom->bm1, "bm1", 1e-12);
    $this->assertEquals(0.9999991390295159156, $astrom->bpn[0][0], "bpn(1,1)",
            1e-12);
    $this->assertEquals(0.4978650072505016932e-7, $astrom->bpn[1][0],
            "bpn(2,1)", 1e-12);
    $this->assertEquals(0.1312227200000000000e-2, $astrom->bpn[2][0],
            "bpn(3,1)", 1e-12);
    $this->assertEquals(-0.1136336653771609630e-7, $astrom->bpn[0][1],
            "bpn(1,2)", 1e-12);
    $this->assertEquals(0.9999999995713154868, $astrom->bpn[1][1], "bpn(2,2)",
            1e-12);
    $this->assertEquals(-0.2928086230000000000e-4, $astrom->bpn[2][1],
            "bpn(3,2)", 1e-12);
    $this->assertEquals(-0.1312227200895260194e-2, $astrom->bpn[0][2],
            "bpn(1,3)", 1e-12);
    $this->assertEquals(0.2928082217872315680e-4, $astrom->bpn[1][2],
            "bpn(2,3)", 1e-12);
    $this->assertEquals(0.9999991386008323373, $astrom->bpn[2][2], "bpn(3,3)",
            1e-12);
    $this->assertEquals(-0.5278008060301974337, $astrom->along, "along", 1e-12);
    $this->assertEquals(0.1133427418174939329e-5, $astrom->xpl, "xpl", 1e-17);
    $this->assertEquals(0.1453347595745898629e-5, $astrom->ypl, "ypl", 1e-17);
    $this->assertEquals(-0.9440115679003211329, $astrom->sphi, "sphi", 1e-12);
    $this->assertEquals(0.3299123514971474711, $astrom->cphi, "cphi", 1e-12);
    $this->assertEquals(0, $astrom->diurab, "diurab", 0);
    $this->assertEquals(2.617608903969802566, $astrom->eral, "eral", 1e-12);
    $this->assertEquals(0.2014187790000000000e-3, $astrom->refa, "refa", 1e-15);
    $this->assertEquals(-0.2361408310000000000e-6, $astrom->refb, "refb", 1e-18);
  }

  public function test_iauApio13() {
    $utc1;
    $utc2;
    $dut1;
    $elong;
    $phi;
    $hm;
    $xp;
    $yp;
    $phpa;
    $tc;
    $rh;
    $wl;
    $j;
    $astrom = new iauASTROM();

    $utc1  = 2456384.5;
    $utc2  = 0.969254051;
    $dut1  = 0.1550675;
    $elong = -0.527800806;
    $phi   = -1.2345856;
    $hm    = 2738.0;
    $xp    = 2.47230737e-7;
    $yp    = 1.82640464e-6;
    $phpa  = 731.0;
    $tc    = 12.8;
    $rh    = 0.59;
    $wl    = 0.55;

    $j = IAU::Apio13($utc1, $utc2, $dut1, $elong, $phi, $hm, $xp, $yp, $phpa,
                    $tc, $rh, $wl, $astrom);

    $this->AssertEquals(-0.5278008060301974337, $astrom->along, "along", 1e-12);
    $this->AssertEquals(0.1133427418174939329e-5, $astrom->xpl, "xpl", 1e-17);
    $this->AssertEquals(0.1453347595745898629e-5, $astrom->ypl, "ypl", 1e-17);
    $this->AssertEquals(-0.9440115679003211329, $astrom->sphi, "sphi", 1e-12);
    $this->AssertEquals(0.3299123514971474711, $astrom->cphi, "cphi", 1e-12);
    $this->AssertEquals(0.5135843661699913529e-6, $astrom->diurab, "diurab",
            1e-12);
    $this->AssertEquals(2.617608909189066140, $astrom->eral, "eral", 1e-12);
    $this->AssertEquals(0.2014187785940396921e-3, $astrom->refa, "refa", 1e-15);
    $this->AssertEquals(-0.2361408314943696227e-6, $astrom->refb, "refb", 1e-18);
    $this->AssertEquals(0, $j, "j");
  }

  public function test_iauAtco13() {
    $rc;
    $dc;
    $pr;
    $pd;
    $px;
    $rv;
    $utc1;
    $utc2;
    $dut1;
    $elong;
    $phi;
    $hm;
    $xp;
    $yp;
    $phpa;
    $tc;
    $rh;
    $wl;
    $aob;
    $zob;
    $hob;
    $dob;
    $rob;
    $eo;
    $j;

    $rc    = 2.71;
    $dc    = 0.174;
    $pr    = 1e-5;
    $pd    = 5e-6;
    $px    = 0.1;
    $rv    = 55.0;
    $utc1  = 2456384.5;
    $utc2  = 0.969254051;
    $dut1  = 0.1550675;
    $elong = -0.527800806;
    $phi   = -1.2345856;
    $hm    = 2738.0;
    $xp    = 2.47230737e-7;
    $yp    = 1.82640464e-6;
    $phpa  = 731.0;
    $tc    = 12.8;
    $rh    = 0.59;
    $wl    = 0.55;

    $j = IAU::Atco13($rc, $dc, $pr, $pd, $px, $rv, $utc1, $utc2, $dut1, $elong,
                    $phi, $hm, $xp, $yp, $phpa, $tc, $rh, $wl, $aob, $zob, $hob,
                    $dob, $rob, $eo);

    $this->assertEquals(0.09251774485358230653, $aob, "aob", 1e-12);
    $this->assertEquals(1.407661405256767021, $zob, "zob", 1e-12);
    $this->assertEquals(-0.09265154431403157925, $hob, "hob", 1e-12);
    $this->assertEquals(0.1716626560075591655, $dob, "dob", 1e-12);
    $this->assertEquals(2.710260453503097719, $rob, "rob", 1e-12);
    $this->assertEquals(-0.003020548354802412839, $eo, "eo", 1e-14);
    $this->assertEquals(0, $j, "j");
  }

  public function test_iauApcg13() {
    $date1;
    $date2;
    $astrom = new iauASTROM();

    $date1 = 2456165.5;
    $date2 = 0.401182685;

    IAU::Apcg13($date1, $date2, $astrom);

    $this->assertEquals(12.65133794027378508, $astrom->pmt, "pmt", 1e-11);
    $this->assertEquals(0.9013108747340644755, $astrom->eb[0], "eb(1)", 1e-12);
    $this->assertEquals(-0.4174026640406119957, $astrom->eb[1], "eb(2)", 1e-12);
    $this->assertEquals(-0.1809822877867817771, $astrom->eb[2], "eb(3)", 1e-12);
    $this->assertEquals(0.8940025429255499549, $astrom->eh[0], "eh(1)", 1e-12);
    $this->assertEquals(-0.4110930268331896318, $astrom->eh[1], "eh(2)", 1e-12);
    $this->assertEquals(-0.1782189006019749850, $astrom->eh[2], "eh(3)", 1e-12);
    $this->assertEquals(1.010465295964664178, $astrom->em, "em", 1e-12);
    $this->assertEquals(0.4289638897157027528e-4, $astrom->v[0], "v(1)", 1e-16);
    $this->assertEquals(0.8115034002544663526e-4, $astrom->v[1], "v(2)", 1e-16);
    $this->assertEquals(0.3517555122593144633e-4, $astrom->v[2], "v(3)", 1e-16);
    $this->assertEquals(0.9999999951686013498, $astrom->bm1, "bm1", 1e-12);
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

  public function test_iauApcs13() {
    $date1;
    $date2;
    $pv     = [];
    $astrom = new iauASTROM();

    $date1    = 2456165.5;
    $date2    = 0.401182685;
    $pv[0][0] = -6241497.16;
    $pv[0][1] = 401346.896;
    $pv[0][2] = -1251136.04;
    $pv[1][0] = -29.264597;
    $pv[1][1] = -455.021831;
    $pv[1][2] = 0.0266151194;

    IAU::Apcs13($date1, $date2, $pv, $astrom);

    $this->assertEquals(12.65133794027378508, $astrom->pmt, "pmt", 1e-11);
    $this->assertEquals(0.9012691529023298391, $astrom->eb[0], "eb(1)", 1e-12);
    $this->assertEquals(-0.4173999812023068781, $astrom->eb[1], "eb(2)", 1e-12);
    $this->assertEquals(-0.1809906511146821008, $astrom->eb[2], "eb(3)", 1e-12);
    $this->assertEquals(0.8939939101759726824, $astrom->eh[0], "eh(1)", 1e-12);
    $this->assertEquals(-0.4111053891734599955, $astrom->eh[1], "eh(2)", 1e-12);
    $this->assertEquals(-0.1782336880637689334, $astrom->eh[2], "eh(3)", 1e-12);
    $this->assertEquals(1.010428384373318379, $astrom->em, "em", 1e-12);
    $this->assertEquals(0.4279877278327626511e-4, $astrom->v[0], "v(1)", 1e-16);
    $this->assertEquals(0.7963255057040027770e-4, $astrom->v[1], "v(2)", 1e-16);
    $this->assertEquals(0.3517564000441374759e-4, $astrom->v[2], "v(3)", 1e-16);
    $this->assertEquals(0.9999999952947981330, $astrom->bm1, "bm1", 1e-12);
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

  public function test_iauAper13() {
    $ut11;
    $ut12;
    $astrom = new iauASTROM();

    $astrom->along = 1.234;
    $ut11          = 2456165.5;
    $ut12          = 0.401182685;

    IAU::Aper13($ut11, $ut12, $astrom);

    $this->assertEquals(3.316236661789694933, $astrom->eral, "pmt", 1e-12);
  }

  public function test_iauAtci13() {
    $rc;
    $dc;
    $pr;
    $pd;
    $px;
    $rv;
    $date1;
    $date2;
    $ri;
    $di;
    $eo;

    $rc    = 2.71;
    $dc    = 0.174;
    $pr    = 1e-5;
    $pd    = 5e-6;
    $px    = 0.1;
    $rv    = 55.0;
    $date1 = 2456165.5;
    $date2 = 0.401182685;

    IAU::Atci13($rc, $dc, $pr, $pd, $px, $rv, $date1, $date2, $ri, $di, $eo);

    $this->assertEquals(2.710121572969038991, $ri, "ri", 1e-12);
    $this->assertEquals(0.1729371367218230438, $di, "di", 1e-12);
    $this->assertEquals(-0.002900618712657375647, $eo, "eo", 1e-14);
  }

  public function test_iauPmp() {
    $a   = [];
    $b   = [];
    $amb = [];

    $a[0] = 2.0;
    $a[1] = 2.0;
    $a[2] = 3.0;

    $b[0] = 1.0;
    $b[1] = 3.0;
    $b[2] = 4.0;

    IAU::Pmp($a, $b, $amb);

    $this->assertEquals(1.0, $amb[0], "0", 1e-12);
    $this->assertEquals(-1.0, $amb[1], "1", 1e-12);
    $this->assertEquals(-1.0, $amb[2], "2", 1e-12);
  }

  public function test_iauPpp() {
    $a   = [];
    $b   = [];
    $apb = [];

    $a[0] = 2.0;
    $a[1] = 2.0;
    $a[2] = 3.0;

    $b[0] = 1.0;
    $b[1] = 3.0;
    $b[2] = 4.0;

    IAU::Ppp($a, $b, $apb);

    $this->assertEquals(3.0, $apb[0], "0", 1e-12);
    $this->assertEquals(5.0, $apb[1], "1", 1e-12);
    $this->assertEquals(7.0, $apb[2], "2", 1e-12);
  }

  public function test_iauPpsp() {
    $a    = [];
    $s;
    $b    = [];
    $apsb = [];

    $a[0] = 2.0;
    $a[1] = 2.0;
    $a[2] = 3.0;

    $s = 5.0;

    $b[0] = 1.0;
    $b[1] = 3.0;
    $b[2] = 4.0;

    IAU::Ppsp($a, $s, $b, $apsb);

    $this->assertEquals(7.0, $apsb[0], "0", 1e-12);
    $this->assertEquals(17.0, $apsb[1], "1", 1e-12);
    $this->assertEquals(23.0, $apsb[2], "2", 1e-12);
  }

  public function test_iauLdn() {
    $n;
    $b  = [new iauLDBODY, new iauLDBody, new iauLDBody];
    $ob = [];
    $sc = [];
    $sn = [];

    $n              = 3;
    $b[0]->bm       = 0.00028574;
    $b[0]->dl       = 3e-10;
    $b[0]->pv[0][0] = -7.81014427;
    $b[0]->pv[0][1] = -5.60956681;
    $b[0]->pv[0][2] = -1.98079819;
    $b[0]->pv[1][0] = 0.0030723249;
    $b[0]->pv[1][1] = -0.00406995477;
    $b[0]->pv[1][2] = -0.00181335842;
    $b[1]->bm       = 0.00095435;
    $b[1]->dl       = 3e-9;
    $b[1]->pv[0][0] = 0.738098796;
    $b[1]->pv[0][1] = 4.63658692;
    $b[1]->pv[0][2] = 1.9693136;
    $b[1]->pv[1][0] = -0.00755816922;
    $b[1]->pv[1][1] = 0.00126913722;
    $b[1]->pv[1][2] = 0.000727999001;
    $b[2]->bm       = 1.0;
    $b[2]->dl       = 6e-6;
    $b[2]->pv[0][0] = -0.000712174377;
    $b[2]->pv[0][1] = -0.00230478303;
    $b[2]->pv[0][2] = -0.00105865966;
    $b[2]->pv[1][0] = 6.29235213e-6;
    $b[2]->pv[1][1] = -3.30888387e-7;
    $b[2]->pv[1][2] = -2.96486623e-7;
    $ob[0]          = -0.974170437;
    $ob[1]          = -0.2115201;
    $ob[2]          = -0.0917583114;
    $sc[0]          = -0.763276255;
    $sc[1]          = -0.608633767;
    $sc[2]          = -0.216735543;

    IAU::Ldn($n, $b, $ob, $sc, $sn);

    $this->assertEquals(-0.7632762579693333866, $sn[0], "1", 1e-12);
    $this->assertEquals(-0.6086337636093002660, $sn[1], "2", 1e-12);
    $this->assertEquals(-0.2167355420646328159, $sn[2], "3", 1e-12);
  }

  public function test_Atciqn() {
    $b      = [new iauLDBODY, new iauLDBODY, new iauLDBODY];
    $date1;
    $date2;
    $eo;
    $rc;
    $dc;
    $pr;
    $pd;
    $px;
    $rv;
    $ri;
    $di;
    $astrom = new iauASTROM();

    $date1          = 2456165.5;
    $date2          = 0.401182685;
    IAU::Apci13($date1, $date2, $astrom, $eo);
    $rc             = 2.71;
    $dc             = 0.174;
    $pr             = 1e-5;
    $pd             = 5e-6;
    $px             = 0.1;
    $rv             = 55.0;
    $b[0]->bm       = 0.00028574;
    $b[0]->dl       = 3e-10;
    $b[0]->pv[0][0] = -7.81014427;
    $b[0]->pv[0][1] = -5.60956681;
    $b[0]->pv[0][2] = -1.98079819;
    $b[0]->pv[1][0] = 0.0030723249;
    $b[0]->pv[1][1] = -0.00406995477;
    $b[0]->pv[1][2] = -0.00181335842;
    $b[1]->bm       = 0.00095435;
    $b[1]->dl       = 3e-9;
    $b[1]->pv[0][0] = 0.738098796;
    $b[1]->pv[0][1] = 4.63658692;
    $b[1]->pv[0][2] = 1.9693136;
    $b[1]->pv[1][0] = -0.00755816922;
    $b[1]->pv[1][1] = 0.00126913722;
    $b[1]->pv[1][2] = 0.000727999001;
    $b[2]->bm       = 1.0;
    $b[2]->dl       = 6e-6;
    $b[2]->pv[0][0] = -0.000712174377;
    $b[2]->pv[0][1] = -0.00230478303;
    $b[2]->pv[0][2] = -0.00105865966;
    $b[2]->pv[1][0] = 6.29235213e-6;
    $b[2]->pv[1][1] = -3.30888387e-7;
    $b[2]->pv[1][2] = -2.96486623e-7;

    IAU::Atciqn($rc, $dc, $pr, $pd, $px, $rv, $astrom, 3, $b, $ri, $di);

    $this->assertEquals(2.710122008105325582, $ri, "ri", 1e-12);
    $this->assertEquals(0.1729371916491459122, $di, "di", 1e-12);
  }

  public function test_iauAtciqz() {
    $date1;
    $date2;
    $eo;
    $rc;
    $dc;
    $ri;
    $di;
    $astrom = new iauASTROM();

    $date1 = 2456165.5;
    $date2 = 0.401182685;
    IAU::Apci13($date1, $date2, $astrom, $eo);
    $rc    = 2.71;
    $dc    = 0.174;

    IAU::Atciqz($rc, $dc, $astrom, $ri, $di);

    $this->assertEquals(2.709994899247599271, $ri, "ri", 1e-12);
    $this->assertEquals(0.1728740720983623469, $di, "di", 1e-12);
  }

  public function test_iauAtic13() {
    $ri;
    $di;
    $date1;
    $date2;
    $rc;
    $dc;
    $eo;

    $ri    = 2.710121572969038991;
    $di    = 0.1729371367218230438;
    $date1 = 2456165.5;
    $date2 = 0.401182685;

    IAU::Atic13($ri, $di, $date1, $date2, $rc, $dc, $eo);

    $this->assertEquals(2.710126504531374930, $rc, "rc", 1e-12);
    $this->assertEquals(0.1740632537628342320, $dc, "dc", 1e-12);
    $this->assertEquals(-0.002900618712657375647, $eo, "eo", 1e-14);
  }

  public function test_iauAticq() {
    $date1;
    $date2;
    $eo;
    $ri;
    $di;
    $rc;
    $dc;
    $astrom = new iauASTROM();

    $date1 = 2456165.5;
    $date2 = 0.401182685;
    IAU::Apci13($date1, $date2, $astrom, $eo);
    $ri    = 2.710121572969038991;
    $di    = 0.1729371367218230438;

    IAU::Aticq($ri, $di, $astrom, $rc, $dc);

    $this->assertEquals(2.710126504531374930, $rc, "rc", 1e-12);
    $this->assertEquals(0.1740632537628342320, $dc, "dc", 1e-12);
  }

  public function test_iauAticqn() {
    $date1;
    $date2;
    $eo;
    $ri;
    $di;
    $rc;
    $dc;
    $b      = [new iauLDBODY, new iauLDBODY, new iauLDBODY];
    $astrom = new iauASTROM();

    $date1          = 2456165.5;
    $date2          = 0.401182685;
    IAU::Apci13($date1, $date2, $astrom, $eo);
    $ri             = 2.709994899247599271;
    $di             = 0.1728740720983623469;
    $b[0]->bm       = 0.00028574;
    $b[0]->dl       = 3e-10;
    $b[0]->pv[0][0] = -7.81014427;
    $b[0]->pv[0][1] = -5.60956681;
    $b[0]->pv[0][2] = -1.98079819;
    $b[0]->pv[1][0] = 0.0030723249;
    $b[0]->pv[1][1] = -0.00406995477;
    $b[0]->pv[1][2] = -0.00181335842;
    $b[1]->bm       = 0.00095435;
    $b[1]->dl       = 3e-9;
    $b[1]->pv[0][0] = 0.738098796;
    $b[1]->pv[0][1] = 4.63658692;
    $b[1]->pv[0][2] = 1.9693136;
    $b[1]->pv[1][0] = -0.00755816922;
    $b[1]->pv[1][1] = 0.00126913722;
    $b[1]->pv[1][2] = 0.000727999001;
    $b[2]->bm       = 1.0;
    $b[2]->dl       = 6e-6;
    $b[2]->pv[0][0] = -0.000712174377;
    $b[2]->pv[0][1] = -0.00230478303;
    $b[2]->pv[0][2] = -0.00105865966;
    $b[2]->pv[1][0] = 6.29235213e-6;
    $b[2]->pv[1][1] = -3.30888387e-7;
    $b[2]->pv[1][2] = -2.96486623e-7;

    IAU::Aticqn($ri, $di, $astrom, 3, $b, $rc, $dc);

    $this->assertEquals(2.709999575032685412, $rc, "rc", 1e-12);
    $this->assertEquals(0.1739999656317778034, $dc, "dc", 1e-12);
  }

  public function test_iauS2p() {
    $p = [0, 0, 0];

    IAU::S2p(-3.21, 0.123, 0.456, $p);

    $this->assertEquals(-0.4514964673880165228, $p[0], "x", 1e-12);
    $this->assertEquals(0.0309339427734258688, $p[1], "y", 1e-12);
    $this->assertEquals(0.0559466810510877933, $p[2], "z", 1e-12);
  }

  public function test_iauS2pv() {
    $pv = [];

    IAU::S2pv(-3.21, 0.123, 0.456, -7.8e-6, 9.01e-6, -1.23e-5, $pv);

    $this->assertEquals(-0.4514964673880165228, $pv[0][0], "x", 1e-12);
    $this->assertEquals(0.0309339427734258688, $pv[0][1], "y", 1e-12);
    $this->assertEquals(0.0559466810510877933, $pv[0][2], "z", 1e-12);

    $this->assertEquals(0.1292270850663260170e-4, $pv[1][0], "vx", 1e-16);
    $this->assertEquals(0.2652814182060691422e-5, $pv[1][1], "vy", 1e-16);
    $this->assertEquals(0.2568431853930292259e-5, $pv[1][2], "vz", 1e-16);
  }

  public function test_iauAtoiq() {
    $utc1;
    $utc2;
    $dut1;
    $elong;
    $phi;
    $hm;
    $xp;
    $yp;
    $phpa;
    $tc;
    $rh;
    $wl;
    $ob1;
    $ob2;
    $ri;
    $di;
    $astrom = new iauASTROM();

    $utc1  = 2456384.5;
    $utc2  = 0.969254051;
    $dut1  = 0.1550675;
    $elong = -0.527800806;
    $phi   = -1.2345856;
    $hm    = 2738.0;
    $xp    = 2.47230737e-7;
    $yp    = 1.82640464e-6;
    $phpa  = 731.0;
    $tc    = 12.8;
    $rh    = 0.59;
    $wl    = 0.55;
    IAU::Apio13($utc1, $utc2, $dut1, $elong, $phi, $hm, $xp, $yp, $phpa, $tc,
            $rh, $wl, $astrom);

    $ob1 = 2.710085107986886201;
    $ob2 = 0.1717653435758265198;
    IAU::Atoiq("R", $ob1, $ob2, $astrom, $ri, $di);
    $this->assertEquals(2.710121574449135955, $ri, "R/ri", 1e-12);
    $this->assertEquals(0.1729371839114567725, $di, "R/di", 1e-12);

    $ob1 = -0.09247619879782006106;
    $ob2 = 0.1717653435758265198;
    IAU::Atoiq("H", $ob1, $ob2, $astrom, $ri, $di);
    $this->assertEquals(2.710121574449135955, $ri, "H/ri", 1e-12);
    $this->assertEquals(0.1729371839114567725, $di, "H/di", 1e-12);

    $ob1 = 0.09233952224794989993;
    $ob2 = 1.407758704513722461;
    IAU::Atoiq("A", $ob1, $ob2, $astrom, $ri, $di);
    $this->assertEquals(2.710121574449135955, $ri, "A/ri", 1e-12);
    $this->assertEquals(0.1729371839114567728, $di, "A/di", 1e-12);
  }

  public function test_iauAtoc13() {
    $utc1;
    $utc2;
    $dut1;
    $elong;
    $phi;
    $hm;
    $xp;
    $yp;
    $phpa;
    $tc;
    $rh;
    $wl;
    $ob1;
    $ob2;
    $rc;
    $dc;
    $j;

    $utc1  = 2456384.5;
    $utc2  = 0.969254051;
    $dut1  = 0.1550675;
    $elong = -0.527800806;
    $phi   = -1.2345856;
    $hm    = 2738.0;
    $xp    = 2.47230737e-7;
    $yp    = 1.82640464e-6;
    $phpa  = 731.0;
    $tc    = 12.8;
    $rh    = 0.59;
    $wl    = 0.55;

    $ob1 = 2.710085107986886201;
    $ob2 = 0.1717653435758265198;
    $j   = IAU::Atoc13("R", $ob1, $ob2, $utc1, $utc2, $dut1, $elong, $phi, $hm,
                    $xp, $yp, $phpa, $tc, $rh, $wl, $rc, $dc);
    $this->assertEquals(2.709956744661000609, $rc, "R/rc", 1e-12);
    $this->assertEquals(0.1741696500895398562, $dc, "R/dc", 1e-12);
    $this->assertEquals(0, $j, "R/j");

    $ob1 = -0.09247619879782006106;
    $ob2 = 0.1717653435758265198;
    $j   = IAU::Atoc13("H", $ob1, $ob2, $utc1, $utc2, $dut1, $elong, $phi, $hm,
                    $xp, $yp, $phpa, $tc, $rh, $wl, $rc, $dc);
    $this->assertEquals(2.709956744661000609, $rc, "H/rc", 1e-12);
    $this->assertEquals(0.1741696500895398562, $dc, "H/dc", 1e-12);
    $this->assertEquals(0, $j, "H/j");

    $ob1 = 0.09233952224794989993;
    $ob2 = 1.407758704513722461;
    $j   = IAU::Atoc13("A", $ob1, $ob2, $utc1, $utc2, $dut1, $elong, $phi, $hm,
                    $xp, $yp, $phpa, $tc, $rh, $wl, $rc, $dc);
    $this->assertEquals(2.709956744661000609, $rc, "A/rc", 1e-12);
    $this->assertEquals(0.1741696500895398565, $dc, "A/dc", 1e-12);
    $this->assertEquals(0, $j, "A/j");
  }

  public function test_iauAtio13() {
    $ri;
    $di;
    $utc1;
    $utc2;
    $dut1;
    $elong;
    $phi;
    $hm;
    $xp;
    $yp;
    $phpa;
    $tc;
    $rh;
    $wl;
    $aob;
    $zob;
    $hob;
    $dob;
    $rob;
    $j;

    $ri    = 2.710121572969038991;
    $di    = 0.1729371367218230438;
    $utc1  = 2456384.5;
    $utc2  = 0.969254051;
    $dut1  = 0.1550675;
    $elong = -0.527800806;
    $phi   = -1.2345856;
    $hm    = 2738.0;
    $xp    = 2.47230737e-7;
    $yp    = 1.82640464e-6;
    $phpa  = 731.0;
    $tc    = 12.8;
    $rh    = 0.59;
    $wl    = 0.55;

    $j = IAU::Atio13($ri, $di, $utc1, $utc2, $dut1, $elong, $phi, $hm, $xp, $yp,
                    $phpa, $tc, $rh, $wl, $aob, $zob, $hob, $dob, $rob);

    $this->assertEquals(0.09233952224794989993, $aob, "aob", 1e-12);
    $this->assertEquals(1.407758704513722461, $zob, "zob", 1e-12);
    $this->assertEquals(-0.09247619879782006106, $hob, "hob", 1e-12);
    $this->assertEquals(0.1717653435758265198, $dob, "dob", 1e-12);
    $this->assertEquals(2.710085107986886201, $rob, "rob", 1e-12);
    $this->assertEquals(0, $j, "j");
  }

}
