<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LeisureCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LeisureCategoryRepository::class)
 */
#[ApiResource(
    paginationEnabled: false,
    normalizationContext: [
        'groups' => ['read:leisureCategory', 'read:leisureCenter']
    ],
    collectionOperations: ['get'],
    itemOperations: ['get']
)]
class LeisureCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:leisureCategory', 'read:leisureCenter'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:leisureCategory', 'read:leisureCenter'])]
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=LeisureCenter::class, mappedBy="leisureCategory")
     */
    private $leisureCenters;


    public function __construct()
    {
        $this->leisureCenters = new ArrayCollection();
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

    /**
     * @return Collection|LeisureCenter[]
     */
    public function getLeisureCenters(): Collection
    {
        return $this->leisureCenters;
    }

}
