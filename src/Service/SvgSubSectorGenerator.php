<?php

namespace  App\Service;
use App\Entity\World;

class SvgSubSectorGenerator {
  public int $baseLength;
  public int $svgHeight;
  public int $svgWidth;
  private SvgHexGenerator $hexGenerator;
  public ?World $world = NULL;

  public function __construct(SvgHexGenerator $hexGenerator) {
    $this->hexGenerator = $hexGenerator;
    $this->baseLength = round(100);
    $this->svgHeight = round($hexGenerator->hexHeight * 10);
    $this->svgWidth = round(($hexGenerator->hexSide * 16) - $this->baseLength);
  }

  public function setBaseLength(int $baseLength): void {
    $this->baseLength = round($baseLength);
    $this->hexGenerator->setBaseLength($baseLength);
    $this->svgHeight = round($this->hexGenerator->hexHeight * 10);
    $this->svgWidth = round(($this->hexGenerator->hexSide * 16) - $this->baseLength);
  }
  
}