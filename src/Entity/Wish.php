<?php

namespace App\Entity;

use App\Repository\WishRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: WishRepository::class)]
class Wish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Idea expected!')]
    #[Assert\Length(min: 2, max: 255, minMessage: 'Min {{ min }} characters!', maxMessage: 'Max {{ max }} characters!')]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\Length(max: 1024, maxMessage: 'Max {{ max }} characters!')]
    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $description = null;

    #[Assert\NotBlank(message: 'Username expected!')]
    #[Assert\Length(min: 2, max: 50, minMessage: 'Min {{ min }} characters!', maxMessage: 'Max {{ max }} characters!')]
    #[ORM\Column(length: 50)]
    private ?string $author = null;

    #[ORM\Column]
    private ?bool $isPublished = null;

    #[ORM\Column]
    private ?\DateTime $dateCreated = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateUpdated = null;

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

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDateCreated(): ?\DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): static
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateUpdated(): ?\DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(\DateTime $dateUpdated): static
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    #[ORM\PrePersist]
    public function create() {
        $this->setIsPublished(true);
        $this->setDateCreated(new \DateTime());
    }

    #[ORM\PreUpdate]
    public function update() {
        $this->setDateUpdated(new \DateTime());
    }
}
