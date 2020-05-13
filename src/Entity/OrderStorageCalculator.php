<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\OrderStorageCalculatorRepository")
 */
class OrderStorageCalculator
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"orders"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Orders", inversedBy="orderStorageCalculators")
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Storage", inversedBy="orderStorageCalculators")
     * @Groups({"orders"})
     */
    private $storage;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"orders"})
     */
    private $pieces;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\StoragePetType", inversedBy="orderStorageCalculators", cascade={"persist", "remove"})
     * @Groups({"orders"})
     */
    private $storagePetType;

    public function __construct()
    {
        $this->storagePetType = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrders(): ?Orders
    {
        return $this->orders;
    }

    public function setOrders(?Orders $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    public function getStorage(): ?Storage
    {
        return $this->storage;
    }

    public function setStorage(?Storage $storage): self
    {
        $this->storage = $storage;

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

    /**
     * @return Collection|StoragePetType[]
     */
    public function getStoragePetType(): Collection
    {
        return $this->storagePetType;
    }

    public function addStoragePetType(StoragePetType $storagePetType): self
    {
        if (!$this->storagePetType->contains($storagePetType)) {
            $this->storagePetType[] = $storagePetType;
        }

        return $this;
    }

    public function removeStoragePetType(StoragePetType $storagePetType): self
    {
        if ($this->storagePetType->contains($storagePetType)) {
            $this->storagePetType->removeElement($storagePetType);
        }

        return $this;
    }
}
