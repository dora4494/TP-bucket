<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Wwish::class)]
    private Collection $wwishes;

    public function __construct()
    {
        $this->wwishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Wwish>
     */
    public function getWwishes(): Collection
    {
        return $this->wwishes;
    }

    public function addWwish(Wwish $wwish): static
    {
        if (!$this->wwishes->contains($wwish)) {
            $this->wwishes->add($wwish);
            $wwish->setCategory($this);
        }

        return $this;
    }

    public function removeWwish(Wwish $wwish): static
    {
        if ($this->wwishes->removeElement($wwish)) {
            // set the owning side to null (unless already changed)
            if ($wwish->getCategory() === $this) {
                $wwish->setCategory(null);
            }
        }

        return $this;
    }
}
