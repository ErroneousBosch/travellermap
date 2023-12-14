<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Entity\Sector;

#[AsTwigComponent]
final class SectorMap
{
  public ?string $sectorId = NULL;
  public ?Sector $sector = NULL;
}
