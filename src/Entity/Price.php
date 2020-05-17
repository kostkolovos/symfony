<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"storage","orders"})
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"storage","orders"})
     */
    private $total;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"storage","orders"})
     */
    private $initial;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"storage","orders"})
     */
    private $profit;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"storage","orders"})
     */
    private $shipping;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Storage", mappedBy="price")
     */
    private $storages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderStorageCalculator", mappedBy="price")
     */
    private $orderStorageCalculators;

    public function __construct()
    {
        $this->storages = new ArrayCollection();
        $this->orderStorageCalculators = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getInitial(): ?float
    {
        return $this->initial;
    }

    public function setInitial(?float $initial): self
    {
        $this->initial = $initial;

        return $this;
    }

    public function getProfit(): ?float
    {
        return $this->profit;
    }

    public function setProfit(?float $profit): self
    {
        $this->profit = $profit;

        return $this;
    }

    public function getShipping(): ?float
    {
        return $this->shipping;
    }

    public function setShipping(?float $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    /**
     * @return Collection|Storage[]
     */
    public function getStorages(): Collection
    {
        return $this->storages;
    }

    public function addStorage(Storage $storage): self
    {
        if (!$this->storages->contains($storage)) {
            $this->storages[] = $storage;
            $storage->setPrice($this);
        }

        return $this;
    }

    public function removeStorage(Storage $storage): self
    {
        if ($this->storages->contains($storage)) {
            $this->storages->removeElement($storage);
            // set the owning side to null (unless already changed)
            if ($storage->getPrice() === $this) {
                $storage->setPrice(null);
            }
        }

        return $this;
    }


    /** @ORM\PrePersist() */
    public function prePersist()
    {
        $sum = $this->initial + $this->profit + $this->shipping;
        $this->total = $sum;
    }


    /** @ORM\PreUpdate() */
    public function preUpdate()
    {
        $sum = $this->initial + $this->profit + $this->shipping;
        $this->total = $sum;
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
            $orderStorageCalculator->setPrice($this);
        }

        return $this;
    }

    public function removeOrderStorageCalculator(OrderStorageCalculator $orderStorageCalculator): self
    {
        if ($this->orderStorageCalculators->contains($orderStorageCalculator)) {
            $this->orderStorageCalculators->removeElement($orderStorageCalculator);
            // set the owning side to null (unless already changed)
            if ($orderStorageCalculator->getPrice() === $this) {
                $orderStorageCalculator->setPrice(null);
            }
        }

        return $this;
    }
}
