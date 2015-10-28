phpSOFA
=======
A PHP port of the IAU SOFA Library


Porting Status
--------------

 Status | Routine | Description
--------|---------|------------------------------------------------
 done   | A2af    | Decompose radians into ° ' "
 done   | A2tf    | Decompose radians into hms
 done   | Ab      | Apply stellar aberration
 done   | Af2a    | Decompose ° ' " into radians
 done   | Anp     | Normalize radians to range 0 to 2pi
 done   | Anpm    | Normalize radians to range -pi to +pi
        | Apcg    | Prepare for ICRS <-> GCRS, geocentric, special
        | Apcg13  | Prepare for ICRS <-> GCRS, geocentric
        | Apci    | Prepare for ICRS <-> CIRS, terrestrial, special
        | Apci13  | Prepare for ICRS <-> CIRS, terrestrial
        | Apco    | Prepare for ICRS <-> observed, terrestrial, special
        | Apco13  | Prepare for ICRS <-> observed, terrestrial
 done   | Apcs    | Prepare for ICRS <-> CIRS, space, special
        | Apcs13  | Prepare for ICRS <-> CIRS, space
 done   | Aper    | Insert ERA into context
        | Aper13  | Update context for Earth rotation
        | Apio    | Prepare for CIRS <-> observed, terrestrial, special
        | Apio13  | Prepare for CIRS <-> observed, terrestrial
        | Atci13  | Catalog -> CIRS
        | Atciq   | Quick ICRS -> CIRS
        | Atciqn  | Quick ICRS -> CIRS, multiple deflections
        | Atciqz  | Quick astrometric ICRS -> CIRS
        | Atco13  | ICRS -> observed
        | Atic13  | CIRS -> ICRS
        | Aticq   | Quick CIRS -> ICRS
        | Aticqn  | Quick CIRS -> ICRS, multiple deflections
        | Atio13  | CIRS -> observed
        | Atioq   | Quick CIRS -> observed
        | Atoc13  | Observed -> astrometric ICRS
        | Atoi13  | Observed -> CIRS
        | AtOiq   | Quick observed -> CIRS
        | Bi00    | Frame bias, ICRS to mean J2000, IAU 2000
        | Bp00    | Frame bias and precession matrices, IAU 2000
        | Bp06    | Frame bias and precession matrices, IAU 2006 precession
        | Bpn2xy  | Bias-precession-nutation matrix given CIP
        | C2i00a  | Celestial-to-intermediate matrix, IAU 2000A
        | C2i00b  | Celestial-to-intermediate matrix, IAU 2000B
        | C2i06a  | Celestial-to-intermediate matrix, IAU 2006/2000A
        | C2ibpn  | Celestial-to-intermediate matrix given b-p-n
        | C2ixy   | Celestial-to-intermediate matrix given CIP
        | C2ixys  | Celestial-to-intermediate matrix given CIP and s
        | C2s     | Unit vector to spherical
        | C2t00a  | Celestial-to-terrestrial matrix, IAU 2000A
        | C2t00b  | Celestial-to-terrestrial matrix, IAU 2000B
        | C2t06a  | Celestial-to-terrestrial matrix, IAU 2006/2000A
        | C2tcio  | form CIO-based celestial-to-terrestrial matrix
        | C2teqx  | Celestial-to-terrestrial matrix, classical
        | C2tpe   | Celestial-to-terrestrial matrix given nutation
        | C2txy   | Celestial-to-terrestrial matrix given CIP
        | Cal2jd  | Gregorian Calendar to Julian Day Number
 done   | Cp      | Copy p-vector
        | Cpv     | Copy pv-vector
        | Cr      | Copy r-matrix
        | D2dtf   | Julian Date to Civil Date
 done   | D2tf    | Decompose days into hms
        | Dat     | Delta(AT) (=TAI-UTC) for a given UTC date
 done   | Dtdb    | TDB-TT
        | Dtf2d   | Civil Date to Julian Date
        | Ee00    | Equation of the equinoxes, IAU 2000
        | Ee00a   | Equation of the equinoxes, IAU 2000A
        | Ee00b   | Equation of the equinoxes, IAU 2000B
        | Ee06a   | Equation of the equinoxes, IAU 2006/2000A
        | Eect00  | Equation of the equinoxes complementary terms
        | Eform   | a,f for a nominated Earth reference ellipsoid
        | Eo06a   | Equation of the origins, IAU 2006/2000A
        | Eors    | Equation of the origins, given NPB matrix and s
        | Epb     | Julian Date to Besselian Epoch
        | Epb2jd  | Besselian Epoch to Julian Date
 done   | Epj     | Julian Date to Julian Epoch
 done   | Epj2jd  | Julian Epoch to Julian Date
        | Epv00   | Earth position and velocity
        | Eqeq94  | Equation of the equinoxes, IAU 1994
 done   | Era00   | Earth Rotation Angle, IAU 2000
        | Fad03   | Mean elongation of the Moon from the Sun
 done   | Fae03   | Mean longitude of Earth
 done   | Faf03   | Mean longitude of the Moon minus mean longitude of the ascending node
 done   | Faju03  | Mean longitude of Jupiter
 done   | Fal03   | Mean anomaly of the Moon
        | Falp03  | Mean anomaly of the Sun
 done   | Fama03  | Mean longitude of Mars
 done   | Fame03  | Mean longitude of Mercury
        | Fane03  | Mean longitude of Neptune
 done   | Faom03  | Mean longitude of the Moon's ascending node
 done   | Fapa03  | General accumulated precession in longitude
 done   | Fasa03  | Mean longitude of Saturn
 done   | Faur03  | Mean longitude of Uranus
 done   | Fave03  | Mean longitude of Venus
        | Fk52h   | Transform FK5 star data into the Hipparcos frame
        | Fk5hip  | FK5 orientation and spin with respect to Hipparcos
        | Fk5hz   | FK5 to Hipparcos assuming zero Hipparcos proper motion
        | Fw2m    | Fukushima-Williams angles to r-matrix
        | Fw2xy   | Fukushima-Williams angles to XY
        | G2icrs  | Transform IAU 1958 galactic coordinates to ICRS
        | Gc2gd   | Geocentric to geodetic transformation using a nominated ellipsoid
        | Gc2gde  | Geocentric to geodetic transformation for ellipsoid given a,f
        | Gd2gc   | Geodetic to geocentric transformation using a nominated ellipsoid
        | Gd2gce  | Geodetic to geocentric transformation for ellipsoid given a,f
 done   | Gmst00  | Greenwich Mean Sidereal Time, IAU 2000
        | Gmst06  | Greenwich mean sidereal time, IAU 2006
        | Gmst82  | Greenwich Mean Sidereal Time, IAU 1982
        | Gst00a  | Greenwich Apparent Sidereal Time, IAU 2000A
        | Gst00b  | Greenwich Apparent Sidereal Time, IAU 2000B
        | Gst06   | Greenwich Apparent sidereal time, IAU 2006, given NPB matrix
        | Gst06a  | Greenwich Apparent sidereal time IAU 2006/2000A
        | Gst94   | Greenwich Apparent Sidereal Time, IAU 1994
        | H2fk5   | Transform Hipparcos star data into the FK5 frame
        | Hfk5z   | Hipparcos to FK5 assuming zero Hipparcos proper motion
        | Icrs2g  | Transform ICRS coordinates to IAU 1958 galactic
 done   | Ir      | Initialize r-matrix to identity
        | Jd2cal  | Julian Date to Gregorian year, month, day, fraction
        | Jdcalf  | Julian Date to Gregorian date for formatted output
        | Ld      | Light deflection by a single solar-system body
        | Ldn     | Light deflection by multiple solar-system bodies
        | Ldsun   | Light deflection by the Sun
        | Num00a  | Nutation matrix, IAU 2000A
        | Num00b  | Nutation matrix, IAU 2000B
        | Num06a  | Nutation matrix, IAU 2006/2000A
        | Numat   | Nutation matrix, generic
 done   | Nut00a  | Nutation, IAU 2000A
 done   | Nut00b  | Nutation, IAU 2000B
 done   | Nut06a  | Nutation, IAU 2006/2000A
 done   | Nut80   | Nutation, IAU 1980
        | Nutm80  | Nutation matrix, IAU 1980
 done   | Obl06   | Mean obliquity, IAU 2006
 done   | Obl80   | Mean obliquity, IAU 1980
        | P06e    | Precession angles, IAU 2006, equinox based
        | P2pv    | Append zero velocity to p-vector
        | P2s     | p-vector to spherical
        | Pap     | Position angle from p-vectors
        | Pas     | Position angle from spherical coordinates
        | Pb06    | Zeta,z,theta precession angles, IAU 2006, including bias
 done   | Pdp     | Inner (=scalar=dot) product of two p-vectors
        | Pfw06   | bias-precession Fukushima-Williams angles IAU 2006
        | Plan94  | Major-planet position and velocity
 done   | Pm      | Modulus of p-vector
        | Pmat00  | Precession matrix (including frame bias), IAU 2000
        | Pmat06  | Precession bias matrix, IAU 2006
        | Pmat76  | Precession matrix, IAU 1976
        | Pmp     | p-vector minus p-vector
        | Pmpx    | Apply proper motion and parallax
        | Pmsafe  | Apply proper motion, with zero-parallax precautions
 done   | Pn      | Normalize p-vector returning modulus
        | Pn00    | b,p,n matrices, IAU 2000, given nutation
        | Pn00a   | b,p,n matrices, IAU 2000A
        | Pn00b   | b,p,n matrices, IAU 2000B
        | Pn06    | Bias, precession, nutation results, IAU 2006
        | Pn06a   | Bias, precession, nutation results, IAU 2006/2000A
        | Pnm00a  | Classical NPB matrix, IAU 2000A
        | Pnm00b  | Classical NPB matrix, IAU 2000B
        | Pnm06a  | Classical NPB matrix, IAU 2006/2000A
        | Pnm80   | Precession/nutation matrix, IAU 1976/1980
        | Pom00   | Polar-motion matrix, IAU 2000
        | Ppp     | p-vector plus p-vector
        | Ppsp    | p-vector plus scaled p-vector
        | Pr00    | Adjustments to IAU 1976 precession, IAU 2000
        | Prec76  | Precession, IAU 1976
        | Pv2p    | Discard velocity component of pv-vector
        | Pv2s    | pv-vector to spherical
        | Pvdpv   | Inner (=scalar=dot) product of two pv-vectors
        | Pvm     | Modulus of pv-vector
        | Pvmpv   | pv-vector minus pv-vector
        | Pvppv   | pv-vector plus pv-vector
        | Pvstar  | Star position+velocity vector to catalog coordinates
        | Pvtob   | Observatory position and velocity
        | Pvu     | Update pv-vector
        | Pvup    | Update pv-vector discarding velocity
        | Pvxpv   | Outer (=vector=cross) product of two pv-vectors
        | Pxp     | Outer (=vector=cross) product of two p-vectors
        | Refco   | Refraction constants
        | Rm2v    | r-matrix to r-vector
        | Rv2m    | r-vector to r-matrix
        | Rx      | Rotate r-matrix about x
        | Rxp     | Product of r-matrix and p-vector
        | Rxpv    | Product of r-matrix and pv-vector
        | Rxr     | r-matrix multiply
        | Ry      | Rotate r-matrix about y
        | Rz      | Rotate r-matrix about z
        | S00     | The CIO locator s, given X,Y, quantity s, IAU 2000A,
        | S00a    | The CIO locator s, IAU 2000A
        | S00b    | The CIO locator s, IAU 2000B
        | S06     | The CIO locator s, given X,Y, IAU 2006
        | S06a    | The CIO locator s, IAU 2006/2000A
        | S2c     | Spherical to unit vector
        | S2p     | Spherical to p-vector
        | S2pv    | Spherical to pv-vector
        | S2xpv   | Multiply pv-vector by two scalars
        | Sepp    | Angular separation from p-vectors
        | Seps    | Angular separation from spherical coordinates
        | Sp00    | The quantity s', IERS 2003
        | Starpm  | Proper motion between two epochs
        | Starpv  | Star catalog coordinates to position+velocity vector
 done   | Sxp     | Multiply p-vector by scalar
        | Sxpv    | Multiply pv-vector by scalar
        | Taitt   | Convert TAI to TT
        | Taiut1  | Convert TAI to UT1
        | Taiutc  | Convert TAI to UTC
        | Tcbtdb  | Convert TCB to TDB
        | Tcgtt   | Convert TCG to TT
        | Tdbtcb  | Convert TDB to TCB
 done   | Tdbtt   | Convert TDB to TT
        | Tf2a    | Decompose hms into radians
        | Tf2d    | Decompose hms into days
        | Tr      | Transpose r-matrix
        | Trxp    | Product of transpose of r-matrix and p-vector
        | Trxpv   | Product of transpose of r-matrix and pv-vector
        | Tttai   | Convert TT to TAI
        | Tttcg   | Convert TT to TCG
        | Tttdb   | Convert TT to TDB
        | Ttut1   | Convert TT to UT1
        | Utctai  | Convert UTC to TAI
        | Utcut1  | Convert UTC to UT1
        | Ut1tai  | Convert UT1 to TAI
        | Ut1tt   | Convert UT1 to TT
        | Ut1utc  | Convert UT1 to UTC
        | Xy06    | CIP, IAU 2006/2000A from series
        | Xys00a  | CIP and s, IAU 2000A
        | Xys00b  | CIP and s, IAU 2000B
        | Xys06a  | CIP and s, IAU 2006/2000A
 done   | Zp      | Zero p-vector
        | Zpv     | Zero pv-vector
        | Zr      | Initialize r-matrix to null

