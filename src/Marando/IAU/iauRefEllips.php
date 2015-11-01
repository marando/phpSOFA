<?php

namespace Marando\IAU;

class iauRefEllips {

  public $value;

  protected function __construct($value) {
    $this->value = $value;
  }

  public static function None() {
    return new static(0);
  }

  public static function WGS84() {
    return new static(WGS84);
  }

  public static function GRS80() {
    return new static(GRS80);
  }

  public static function WGS72() {
    return new static(WGS72);
  }

}
