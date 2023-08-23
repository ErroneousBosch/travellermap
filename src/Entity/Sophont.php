<?php

namespace App\Entity;

use App\Repository\SophontRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SophontRepository::class)]
class Sophont
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 4)]
    private ?string $code = null;

    #[ORM\ManyToMany(targetEntity: Sector::class, inversedBy: 'sophonts')]
    private Collection $location;

    #[ORM\OneToMany(mappedBy: 'sophonts', targetEntity: Remark::class)]
    private Collection $remarks;

    public function __construct()
    {
        $this->location = new ArrayCollection();
        $this->remarks = new ArrayCollection();
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

    /**
     * @return Collection<int, Remark>
     */
    public function getRemarks(): Collection
    {
        return $this->remarks;
    }

    public function addRemark(Remark $remark): static
    {
        if (!$this->remarks->contains($remark)) {
            $this->remarks->add($remark);
            $remark->setSophonts($this);
        }

        return $this;
    }

    public function removeRemark(Remark $remark): static
    {
        if ($this->remarks->removeElement($remark)) {
            // set the owning side to null (unless already changed)
            if ($remark->getSophonts() === $this) {
                $remark->setSophonts(null);
            }
        }

        return $this;
    }
}
