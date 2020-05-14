<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"orders"},"enable_max_depth"=true},
 *     denormalizationContext={"groups"={"orders"}}
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"orders"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"orders"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"orders"})
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"orders"})
     */
    private $status = 1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderStorageCalculator", mappedBy="orders", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"orders"})
     */
    private $orderStorageCalculators;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"orders"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="orders", cascade={"persist", "remove"})
     * @Groups({"orders"})
     */
    private $customer;

    public function __construct()
    {
        $this->orderStorageCalculators = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
            $orderStorageCalculator->setOrders($this);
        }

        return $this;
    }

    public function removeOrderStorageCalculator(OrderStorageCalculator $orderStorageCalculator): self
    {
        if ($this->orderStorageCalculators->contains($orderStorageCalculator)) {
            $this->orderStorageCalculators->removeElement($orderStorageCalculator);
            // set the owning side to null (unless already changed)
            if ($orderStorageCalculator->getOrders() === $this) {
                $orderStorageCalculator->setOrders(null);
            }
        }

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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
