<?php

namespace App\Entity;

use App\Repository\LeisureCenterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeisureCenterRepository::class)
 */
class LeisureCenter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\ManyToMany(targetEntity=LeisureCategory::class, inversedBy="leisureCenters")
     */
    private $leisureCategory;

    public function __construct()
    {
        $this->leisureCategory = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|LeisureCategory[]
     */
    public function getLeisureCategory(): Collection
    {
        return $this->leisureCategory;
    }

    public function addLeisureCategory(LeisureCategory $leisureCategory): self
    {
        if (!$this->leisureCategory->contains($leisureCategory)) {
            $this->leisureCategory[] = $leisureCategory;
        }

        return $this;
    }

    public function removeLeisureCategory(LeisureCategory $leisureCategory): self
    {
        $this->leisureCategory->removeElement($leisureCategory);

        return $this;
    }

}
