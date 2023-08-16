<?php

namespace App\Entity;

use App\Repository\WwishRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WwishRepository::class)]
class Wwish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 250)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $author = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPublished = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCreated = null;

    #[ORM\Column(nullable: true)]
    private ?int $di = null;

    #[ORM\Column]
    private ?int $test = null;

    #[ORM\Column(nullable: true)]
    private ?int $pil = null;

    #[ORM\ManyToOne(inversedBy: 'wwishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(?bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(?\DateTimeInterface $dateCreated): static
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDi(): ?int
    {
        return $this->di;
    }

    public function setDi(?int $di): static
    {
        $this->di = $di;

        return $this;
    }

    public function getTest(): ?int
    {
        return $this->test;
    }

    public function setTest(int $test): static
    {
        $this->test = $test;

        return $this;
    }

    public function getPil(): ?int
    {
        return $this->pil;
    }

    public function setPil(?int $pil): static
    {
        $this->pil = $pil;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }



}
