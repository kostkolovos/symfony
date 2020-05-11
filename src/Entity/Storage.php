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
     * @Groups({"storage"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"storage"})
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"storage"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"storage"})
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"storage"})
     */
    private $status = 1;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"storage"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"storage"})
     */
    private $pieces = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"storage"})
     */
    private $price = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StorageTypes", inversedBy="storages", cascade={"persist", "remove"})
     * @Groups({"storage"})
     */
    private $storageTypes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\StoragePetType", mappedBy="storage", cascade={"persist", "remove"})
     * @Groups({"storage"})
     * @MaxDepth(2)
     */
    private $storagePetTypes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Orders", mappedBy="storage")
     */
    private $orders;

    public function __construct()
    {
        $this->storagePetTypes = new ArrayCollection();
        $this->orders = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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
     * @return Collection|Orders[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->addStorage($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            $order->removeStorage($this);
        }

        return $this;
    }

}
