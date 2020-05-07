<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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

}
