<?php

namespace App\Entity;

use App\Repository\SectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectorRepository::class)]
class Sector
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $x = null;

    #[ORM\Column]
    private ?int $y = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $abbreviation = null;

    #[ORM\Column]
    private array $names = [];

    #[ORM\Column(nullable: true)]
    private ?array $subsectors = null;

    #[ORM\Column(nullable: true)]
    private ?array $borders = null;

    #[ORM\Column(nullable: true)]
    private ?array $routes = null;

    #[ORM\OneToMany(mappedBy: 'sector', targetEntity: World::class)]
    private Collection $worlds;

    #[ORM\ManyToMany(targetEntity: Sophont::class, mappedBy: 'location')]
    private Collection $sophonts;

    #[ORM\ManyToMany(targetEntity: Allegiance::class, mappedBy: 'location')]
    private Collection $allegiances;

    #[ORM\Column(length: 255)]
    private ?string $uniqid = null;

    public function __construct()
    {
        $this->worlds = new ArrayCollection();
        $this->sophonts = new ArrayCollection();
        $this->allegiances = new ArrayCollection();
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

    public function getX(): ?int
    {
        return $this->x;
    }

    public function setX(int $x): static
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function setY(int $y): static
    {
        $this->y = $y;

        return $this;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation ?? $this->name;
    }

    public function setAbbreviation(?string $abbreviation): static
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    public function getNames(): array
    {
        return $this->names;
    }

    public function setNames(array $names): static
    {
        $this->names = $names;

        return $this;
    }

    public function getSubsectors(): ?array
    {
        return $this->subsectors;
    }

    public function setSubsectors(?array $subsectors): static
    {
        $this->subsectors = $subsectors;

        return $this;
    }

    public function getBorders(): ?array
    {
        return $this->borders;
    }

    public function setBorders(?array $borders): static
    {
        $this->borders = $borders;

        return $this;
    }

    public function getRoutes(): ?array
    {
        return $this->routes;
    }

    public function setRoutes(?array $routes): static
    {
        $this->routes = $routes;

        return $this;
    }

    /**
     * @return Collection<int, World>
     */
    public function getWorlds(): Collection
    {
        return $this->worlds;
    }

    public function addWorld(World $world): static
    {
        if (!$this->worlds->contains($world)) {
            $this->worlds->add($world);
            $world->setSector($this);
        }

        return $this;
    }

    public function removeWorld(World $world): static
    {
        if ($this->worlds->removeElement($world)) {
            // set the owning side to null (unless already changed)
            if ($world->getSector() === $this) {
                $world->setSector(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sophont>
     */
    public function getSophonts(): Collection
    {
        return $this->sophonts;
    }

    public function addSophont(Sophont $sophont): static
    {
        if (!$this->sophonts->contains($sophont)) {
            $this->sophonts->add($sophont);
            $sophont->addLocation($this);
        }

        return $this;
    }

    public function removeSophont(Sophont $sophont): static
    {
        if ($this->sophonts->removeElement($sophont)) {
            $sophont->removeLocation($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Allegiance>
     */
    public function getAllegiances(): Collection
    {
        return $this->allegiances;
    }

    public function addAllegiance(Allegiance $allegiance): static
    {
        if (!$this->allegiances->contains($allegiance)) {
            $this->allegiances->add($allegiance);
            $allegiance->addLocation($this);
        }

        return $this;
    }

    public function removeAllegiance(Allegiance $allegiance): static
    {
        if ($this->allegiances->removeElement($allegiance)) {
            $allegiance->removeLocation($this);
        }

        return $this;
    }

    public function getUniqid(): ?string
    {
        return $this->uniqid;
    }

    public function setUniqid(string $uniqid): static
    {
        $this->uniqid = $uniqid;

        return $this;
    }
}
