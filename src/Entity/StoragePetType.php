<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StoragePetTypeRepository")
 */
class StoragePetType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"storage"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Storage", inversedBy="storagePetTypes")
     * @Groups({"storage"})
     */
    private $storage;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"storage"})
     */
    private $microchip;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"storage"})
     */
    private $male;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"storage"})
     */
    private $female;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"storage"})
     */
    private $booklet;

    public function __construct()
    {
        $this->storage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Storage[]
     */
    public function getStorage(): Collection
    {
        return $this->storage;
    }

    public function addStorage(Storage $storage): self
    {
        if (!$this->storage->contains($storage)) {
            $this->storage[] = $storage;
        }

        return $this;
    }

    public function removeStorage(Storage $storage): self
    {
        if ($this->storage->contains($storage)) {
            $this->storage->removeElement($storage);
        }

        return $this;
    }

    public function getMicrochip(): ?string
    {
        return $this->microchip;
    }

    public function setMicrochip(string $microchip): self
    {
        $this->microchip = $microchip;

        return $this;
    }

    public function getMale(): ?int
    {
        return $this->male;
    }

    public function setMale(?int $male): self
    {
        $this->male = $male;

        return $this;
    }

    public function getFemale(): ?int
    {
        return $this->female;
    }

    public function setFemale(?int $female): self
    {
        $this->female = $female;

        return $this;
    }

    public function getBooklet(): ?string
    {
        return $this->booklet;
    }

    public function setBooklet(?string $booklet): self
    {
        $this->booklet = $booklet;

        return $this;
    }
}
