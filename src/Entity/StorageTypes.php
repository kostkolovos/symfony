<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StorageTypesRepository")
 */
class StorageTypes
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
     * @ORM\Column(type="integer")
     * @Groups({"storage","orders"})
     */
    private $sort;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Storage", mappedBy="storageTypes")
     */
    private $storages;

    public function __construct()
    {
        $this->storages = new ArrayCollection();
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

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;

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
            $storage->setStorageTypes($this);
        }

        return $this;
    }

    public function removeStorage(Storage $storage): self
    {
        if ($this->storages->contains($storage)) {
            $this->storages->removeElement($storage);
            // set the owning side to null (unless already changed)
            if ($storage->getStorageTypes() === $this) {
                $storage->setStorageTypes(null);
            }
        }

        return $this;
    }
}
