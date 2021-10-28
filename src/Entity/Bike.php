<?php

namespace App\Entity;

use App\Repository\BikeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BikeRepository::class)
 */
class Bike
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
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="bikes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=BikePhoto::class, mappedBy="bike", orphanRemoval=true, cascade={"persist"})
     */
    private $bikePhotos;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $count;

    public function __construct()
    {
        $this->bikePhotos = new ArrayCollection();
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|BikePhoto[]
     */
    public function getBikePhotos(): Collection
    {
        return $this->bikePhotos;
    }

    public function addBikePhoto(BikePhoto $bikePhoto): self
    {
        if (!$this->bikePhotos->contains($bikePhoto)) {
            $this->bikePhotos[] = $bikePhoto;
            $bikePhoto->setBike($this);
        }

        return $this;
    }

    public function removeBikePhoto(BikePhoto $bikePhoto): self
    {
        if ($this->bikePhotos->removeElement($bikePhoto)) {
            // set the owning side to null (unless already changed)
            if ($bikePhoto->getBike() === $this) {
                $bikePhoto->setBike(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }
}
