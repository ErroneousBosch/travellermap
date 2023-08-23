<?php

namespace App\Entity;

use App\Repository\RemarkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RemarkRepository::class)]
class Remark
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $code = null;

    #[ORM\Column(length: 16)]
    private ?string $uniqid = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $extra_info = null;

    #[ORM\ManyToMany(targetEntity: World::class, mappedBy: 'remarks')]
    private Collection $worlds;

    #[ORM\ManyToOne(inversedBy: 'remarks')]
    private ?Sophont $sophonts = null;

    public function __construct()
    {
        $this->worlds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getExtraInfo(): ?string
    {
        return $this->extra_info;
    }

    public function setExtraInfo(?string $extra_info): static
    {
        $this->extra_info = $extra_info;

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
            $world->addRemark($this);
        }

        return $this;
    }

    public function removeWorld(World $world): static
    {
        if ($this->worlds->removeElement($world)) {
            $world->removeRemark($this);
        }

        return $this;
    }

    public function getSophonts(): ?Sophont
    {
        return $this->sophonts;
    }

    public function setSophonts(?Sophont $sophonts): static
    {
        $this->sophonts = $sophonts;

        return $this;
    }


}
