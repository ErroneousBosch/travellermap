<?php

namespace App\Entity;

use App\Repository\WorldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorldRepository::class)]
class World
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'worlds', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sector $sector = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $UWP = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $starport_class = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $size = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $atmosphere = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $hydrographics = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $population_exponent = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $government = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $law_level = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $tech_level = null;

    #[ORM\Column(nullable: true)]
    private ?int $importance = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $economy = null;

    #[ORM\Column(nullable: true)]
    private ?int $resources = null;

    #[ORM\Column(nullable: true)]
    private ?int $labor = null;

    #[ORM\Column(nullable: true)]
    private ?int $infrastructure = null;

    #[ORM\Column(nullable: true)]
    private ?int $efficiency = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $culture = null;

    #[ORM\Column(nullable: true)]
    private ?int $heterogeneity = null;

    #[ORM\Column(nullable: true)]
    private ?int $acceptance = null;

    #[ORM\Column(nullable: true)]
    private ?int $strangeness = null;

    #[ORM\Column(nullable: true)]
    private ?int $symbols = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $nobility = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $bases = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $zone = null;

    #[ORM\Column(length: 3)]
    private ?string $pbg = null;

    #[ORM\Column(nullable: true)]
    private ?int $population_multiplier = null;

    #[ORM\Column(nullable: true)]
    private ?int $belts = null;

    #[ORM\Column(nullable: true)]
    private ?int $gas_giants = null;

    #[ORM\Column]
    private ?int $bodies = null;

    #[ORM\Column]
    private array $stellar_data = [];

    #[ORM\Column(nullable: true)]
    private ?int $ru = null;

    #[ORM\ManyToMany(targetEntity: Remark::class, inversedBy: 'worlds', cascade: ['persist'])]
    private Collection $remarks;

    #[ORM\Column(length: 255)]
    private ?string $uniqid = null;

    #[ORM\OneToMany(mappedBy: 'control', targetEntity: Remark::class, cascade: ['persist'])]
    private Collection $controls;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $milieu = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $subsector = null;

    #[ORM\ManyToOne(inversedBy: 'worlds', cascade: ['persist'])]
    private ?Allegiance $allegiance = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $hex = null;

    public function __construct()
    {
        $this->remarks = new ArrayCollection();
        $this->controls = new ArrayCollection();
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

    public function getSector(): ?Sector
    {
        return $this->sector;
    }

    public function setSector(?Sector $sector): static
    {
        $this->sector = $sector;

        return $this;
    }

    public function getUWP(): ?string
    {
        return $this->UWP;
    }

    public function setUWP(?string $UWP): static
    {
        $this->UWP = $UWP;
        $this->setStarportClass(substr($UWP, 0, 1));
        $this->setSize(substr($UWP, 1, 1));
        $this->setAtmosphere(substr($UWP, 2, 1));
        $this->setHydrographics(substr($UWP, 3, 1));
        $this->setPopulationExponent(substr($UWP, 4, 1));
        $this->setGovernment(substr($UWP, 5, 1));
        $this->setLawLevel(substr($UWP, 6, 1));
        $this->setTechLevel(substr($UWP, 8, 1));

        return $this;
    }

    public function getStarportClass(): ?string
    {
        return $this->starport_class;
    }

    public function setStarportClass(?string $starport_class): static
    {
        $this->starport_class = $starport_class;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getAtmosphere(): ?string
    {
        return $this->atmosphere;
    }

    public function setAtmosphere(?string $atmosphere): static
    {
        $this->atmosphere = $atmosphere;

        return $this;
    }

    public function getHydrographics(): ?string
    {
        return $this->hydrographics;
    }

    public function setHydrographics(?string $hydrographics): static
    {
        $this->hydrographics = $hydrographics;

        return $this;
    }

    public function getPopulationExponent(): ?string
    {
        return $this->population_exponent;
    }

    public function setPopulationExponent(?string $population_exponent): static
    {
        $this->population_exponent = $population_exponent;

        return $this;
    }

    public function getGovernment(): ?string
    {
        return $this->government;
    }

    public function setGovernment(?string $government): static
    {
        $this->government = $government;

        return $this;
    }

    public function getLawLevel(): ?string
    {
        return $this->law_level;
    }

    public function setLawLevel(?string $law_level): static
    {
        $this->law_level = $law_level;

        return $this;
    }

    public function getTechLevel(): ?string
    {
        return $this->tech_level;
    }

    public function setTechLevel(?string $tech_level): static
    {
        $this->tech_level = $tech_level;

        return $this;
    }

    public function getImportance(): ?int
    {
        return $this->importance;
    }

    public function setImportance(?int $importance): static
    {
        $this->importance = $importance;

        return $this;
    }

    public function getEconomy(): ?string
    {
        return $this->economy;
    }

    public function setEconomy(?string $economy): static
    {
        $this->economy = $economy;
        $this->setResources(substr($economy, 0, 1));
        $this->setLabor(substr($economy, 1, 1));
        $this->setInfrastructure(substr($economy, 2, 1));

        return $this;
    }

    public function getResources(): ?string
    {
        return $this->resources;
    }

    public function setResources(?string $resources): static
    {
        $this->resources = $resources;

        return $this;
    }

    public function getLabor(): ?string
    {
        return $this->labor;
    }

    public function setLabor(?string $labor): static
    {
        $this->labor = $labor;

        return $this;
    }

    public function getInfrastructure(): ?string
    {
        return $this->infrastructure;
    }

    public function setInfrastructure(?string $infrastructure): static
    {
        $this->infrastructure = $infrastructure;

        return $this;
    }

    public function getEfficiency(): ?int
    {
        return $this->efficiency;
    }

    public function setEfficiency(?int $efficiency): static
    {
        $this->efficiency = $efficiency;

        return $this;
    }

    public function getCulture(): ?string
    {
        return $this->culture;
    }

    public function setCulture(?string $culture): static
    {
        $this->culture = $culture;
        $this->setHeterogeneity(substr($culture, 0, 1));
        $this->setAcceptance(substr($culture, 1, 1));
        $this->setStrangeness(substr($culture, 2, 1));
        $this->setSymbols(substr($culture, 3, 1));

        return $this;
    }

    public function getHeterogeneity(): ?int
    {
        return $this->heterogeneity;
    }

    public function setHeterogeneity(?int $heterogeneity): static
    {
        $this->heterogeneity = $heterogeneity;

        return $this;
    }

    public function getAcceptance(): ?int
    {
        return $this->acceptance;
    }

    public function setAcceptance(?int $acceptance): static
    {
        $this->acceptance = $acceptance;

        return $this;
    }

    public function getStrangeness(): ?int
    {
        return $this->strangeness;
    }

    public function setStrangeness(?int $strangeness): static
    {
        $this->strangeness = $strangeness;

        return $this;
    }

    public function getSymbols(): ?int
    {
        return $this->symbols;
    }

    public function setSymbols(?int $symbols): static
    {
        $this->symbols = $symbols;

        return $this;
    }

    public function getNobility(): ?string
    {
        return $this->nobility;
    }

    public function setNobility(?string $nobility): static
    {
        $this->nobility = $nobility;

        return $this;
    }

    public function getBases(): ?string
    {
        return $this->bases;
    }

    public function setBases(?string $bases): static
    {
        $this->bases = $bases;

        return $this;
    }

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(?string $zone): static
    {
        $this->zone = $zone;

        return $this;
    }

    public function getPBG(): ?string
    {
        return $this->pbg;
    }

    public function setPBG(string $pbg): static
    {
        $this->pbg = $pbg;
        $this->setPopulationMultiplier(substr($pbg, 0, 1));
        $this->setBelts(substr($pbg, 1, 1));
        $this->setGasGiants(substr($pbg, 2, 1));

        return $this;
    }

    public function getPopulationMultiplier(): ?int
    {
        return $this->population_multiplier;
    }

    public function setPopulationMultiplier(?int $population_multiplier): static
    {
        $this->population_multiplier = $population_multiplier;

        return $this;
    }

    public function getBelts(): ?int
    {
        return $this->belts;
    }

    public function setBelts(?int $belts): static
    {
        $this->belts = $belts;

        return $this;
    }

    public function getGasGiants(): ?int
    {
        return $this->gas_giants;
    }

    public function setGasGiants(?int $gas_giants): static
    {
        $this->gas_giants = $gas_giants;

        return $this;
    }

    public function getBodies(): ?int
    {
        return $this->bodies;
    }

    public function setBodies(?int $bodies): static
    {
        $this->bodies = $bodies;

        return $this;
    }

    public function getStellarData(): array
    {
        return $this->stellar_data;
    }

    public function setStellarData(array $stellar_data): static
    {
        $this->stellar_data = $stellar_data;

        return $this;
    }

    public function getRU(): ?int
    {
        return $this->ru;
    }

    public function setRU(?int $ru): static
    {
        $this->ru = $ru;

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
        }

        return $this;
    }

    public function removeRemark(Remark $remark): static
    {
        $this->remarks->removeElement($remark);

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

    /**
     * @return Collection<int, Remark>
     */
    public function getcontrols(): Collection
    {
        return $this->controls;
    }

    public function addcontrols(Remark $controls): static
    {
        if (!$this->controls->contains($controls)) {
            $this->controls->add($controls);
            $controls->setControl($this);
        }

        return $this;
    }

    public function removecontrols(Remark $controls): static
    {
        if ($this->controls->removeElement($controls)) {
            // set the owning side to null (unless already changed)
            if ($controls->getControl() === $this) {
                $controls->setControl(null);
            }
        }

        return $this;
    }

    public function getMilieu(): ?string
    {
        return $this->milieu;
    }

    public function setMilieu(?string $milieu): static
    {
        $this->milieu = $milieu;

        return $this;
    }

    public function getSubsector(): ?string
    {
        return $this->subsector;
    }

    public function setSubsector(?string $subsector): static
    {
        $this->subsector = $subsector;

        return $this;
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

    public function getHex(): ?string
    {
        return $this->hex;
    }

    public function setHex(?string $hex): static
    {
        $this->hex = $hex;

        return $this;
    }

}
