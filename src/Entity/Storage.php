<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"storage"},"enable_max_depth"=true},
 *     denormalizationContext={"groups"={"storage"}}
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\StorageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Storage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"storage","orders"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"storage","orders"})
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"storage","orders"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"storage","orders"})
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"storage","orders"})
     */
    private $status = 1;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"storage","orders"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"storage","orders"})
     */
    private $pieces = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StorageTypes", inversedBy="storages", cascade={"persist", "remove"})
     * @Groups({"storage","orders"})
     */
    private $storageTypes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\StoragePetType", mappedBy="storage", cascade={"persist", "remove"})
     * @Groups({"storage"})
     * @MaxDepth(2)
     */
    private $storagePetTypes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderStorageCalculator", mappedBy="storage")
     */
    private $orderStorageCalculators;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Price", inversedBy="storages", cascade={"persist", "remove"})
     * @Groups({"storage","orders"})
     * @MaxDepth(2)
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MediaObject", inversedBy="storages")
     * @Groups({"storage","orders"})
     * @MaxDepth(2)
     */
    private $image;

    public function __construct()
    {
        $this->storagePetTypes = new ArrayCollection();
        $this->orderStorageCalculators = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /** @ORM\PrePersist() */
    public function prePersist()
    {
        $today = new \DateTime();
        $this->createdAt = $today;
    }


    /** @ORM\PreUpdate() */
    public function preUpdate()
    {
        $today = new \DateTime();
        $this->updatedAt = $today;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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

    public function getPieces(): ?int
    {
        return $this->pieces;
    }

    public function setPieces(int $pieces): self
    {
        $this->pieces = $pieces;

        return $this;
    }

    public function getStorageTypes(): ?StorageTypes
    {
        return $this->storageTypes;
    }

    public function setStorageTypes(?StorageTypes $storageTypes): self
    {
        $this->storageTypes = $storageTypes;

        return $this;
    }

    /**
     * @return Collection|StoragePetType[]
     */
    public function getStoragePetTypes(): Collection
    {
        return $this->storagePetTypes;
    }

    public function addStoragePetType(StoragePetType $storagePetType): self
    {
        if (!$this->storagePetTypes->contains($storagePetType)) {
            $this->storagePetTypes[] = $storagePetType;
            $storagePetType->addStorage($this);
        }

        return $this;
    }

    public function removeStoragePetType(StoragePetType $storagePetType): self
    {
        if ($this->storagePetTypes->contains($storagePetType)) {
            $this->storagePetTypes->removeElement($storagePetType);
            $storagePetType->removeStorage($this);
        }

        return $this;
    }

    /**
     * @return Collection|OrderStorageCalculator[]
     */
    public function getOrderStorageCalculators(): Collection
    {
        return $this->orderStorageCalculators;
    }

    public function addOrderStorageCalculator(OrderStorageCalculator $orderStorageCalculator): self
    {
        if (!$this->orderStorageCalculators->contains($orderStorageCalculator)) {
            $this->orderStorageCalculators[] = $orderStorageCalculator;
            $orderStorageCalculator->setStorage($this);
        }

        return $this;
    }

    public function removeOrderStorageCalculator(OrderStorageCalculator $orderStorageCalculator): self
    {
        if ($this->orderStorageCalculators->contains($orderStorageCalculator)) {
            $this->orderStorageCalculators->removeElement($orderStorageCalculator);
            // set the owning side to null (unless already changed)
            if ($orderStorageCalculator->getStorage() === $this) {
                $orderStorageCalculator->setStorage(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?Price
    {
        return $this->price;
    }

    public function setPrice(?Price $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?MediaObject
    {
        return $this->image;
    }

    public function setImage(?MediaObject $image): self
    {
        $this->image = $image;

        return $this;
    }

}
