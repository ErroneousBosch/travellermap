<?php

namespace  App\Service;

class SvgHexGenerator {
  public int $baseLength;
  public int $hexHeight;
  public int $hexSide;


  public function __construct(int $baseLength = 100) {
    $this->baseLength = round($baseLength);
    $this->hexHeight = round($this->baseLength * sqrt(3)) * 2;
    $this->hexSide = round($this->baseLength * 2);
  }
  
  function setBaseLength(int $baseLength): void {
    $this->baseLength = round($baseLength);
    $this->hexHeight = round($this->baseLength * sqrt(3)) * 2;
    $this->hexSide = round($this->baseLength * 2);
  }

  /**
   * Generates a an equilateral hexagon
   */
  public function generateHexagon(?int $length = NULL): string {
    $b = $length;
    $a = $this->hexHeight/2;
    $h = $this->hexSide;
    $x1 = ($b+$h);
    $x2 = ($b+$h+$b);
    $y1 = $this->hexHeight;
    //generate polyline hexagon, flat top
    $hexagon = "<polyline points='0,$a $b,0 $x1,0 $x2,$a $x1,$y1 $b,$y1 0,$a'/>";
    return $hexagon;
  }


}