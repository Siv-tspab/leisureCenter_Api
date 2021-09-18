<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\LeisureCenterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeisureCenterRepository::class)
 */
#[ApiResource(
    itemOperations: [
        'get',
        'patch',
        'delete'
    ],
    collectionOperations: [
        'get',
        'post'
    ]
), ApiFilter(
    SearchFilter::class, properties: ['leisureCategory.id' => 'exact', 'name' => 'partial', 'description' => 'partial']
)]
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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
