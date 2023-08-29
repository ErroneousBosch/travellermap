<?php

namespace App\Entity;

use App\Repository\WorldsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorldsRepository::class)]
class Worlds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'worlds')]
    private ?Allegiance $allegiance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAllegiance(): ?Allegiance
    {
        return $this->allegiance;
    }

    public function setAllegiance(?Allegiance $allegiance): static
    {
        $this->allegiance = $allegiance;

        return $this;
    }
}
