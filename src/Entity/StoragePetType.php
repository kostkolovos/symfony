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
     * @ORM\Column(type="boolean")
     * @Groups({"storage"})
     */
    private $microchip;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Storage", inversedBy="storagePetTypes")
     * @Groups({"storage"})
     */
    private $storage;

    public function __construct()
    {
        $this->storage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMicrochip(): ?bool
    {
        return $this->microchip;
    }

    public function setMicrochip(bool $microchip): self
    {
        $this->microchip = $microchip;

        return $this;
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
}
