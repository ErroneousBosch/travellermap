<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;


#[AsTwigComponent]
final class UtilitySVG
{
  public int $baseLength;
  private int $hexHeight;
  private int $hexSide;


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
  public function generateHexagon(?array $offset = NULL): string {
    $b = $this->baseLength;
    $a = $this->hexHeight/2;
    $h = $this->hexSide;
    $x1 = ($b+$h);
    $x2 = ($b+$h+$b);
    $y1 = $this->hexHeight;
  
    $hexagon = <<<PHP_EOL
    <line class='hex-side-1 hex-side' x1='0' y1='$a' x2='$b' y2='0' />
    <line class='hex-side-2 hex-side' x1='$b' y1='0' x2='$x1' y2='0' />
    <line class='hex-side-3 hex-side' x1='$x1' y1='0' x2='$x2' y2='$a' />
    <line class='hex-side-4 hex-side' x1='$x2' y1='$a' x2='$x1' y2='$y1' />
    <line class='hex-side-5 hex-side' x1='$x1' y1='$y1' x2='$b' y2='$y1' />
    <line class='hex-side-6 hex-side' x1='$b' y1='$y1' x2='0' y2='$a' />
    PHP_EOL;
    return $hexagon;
  }
}
