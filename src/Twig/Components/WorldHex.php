<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Entity\Sector;

#[AsTwigComponent]
final class WorldHex
{

  public Sector $sector;
  public int $sectorId;



}
