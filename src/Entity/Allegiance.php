<?php

namespace App\Entity;

use App\Repository\AllegianceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllegianceRepository::class)]
class Allegiance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 4)]
    private ?string $code = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $legacy_code = null;

    #[ORM\ManyToMany(targetEntity: Sector::class, inversedBy: 'allegiances')]
    private Collection $location;

    public function __construct()
    {
        $this->location = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getLegacyCode(): ?string
    {
        return $this->legacy_code;
    }

    public function setLegacyCode(?string $legacy_code): static
    {
        $this->legacy_code = $legacy_code;

        return $this;
    }

    /**
     * @return Collection<int, Sector>
     */
    public function getLocation(): Collection
    {
        return $this->location;
    }

    public function addLocation(Sector $location): static
    {
        if (!$this->location->contains($location)) {
            $this->location->add($location);
        }

        return $this;
    }

    public function removeLocation(Sector $location): static
    {
        $this->location->removeElement($location);

        return $this;
    }
}
