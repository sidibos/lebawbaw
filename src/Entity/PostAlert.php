<?php

namespace App\Entity;

use App\Repository\PostAlertRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostAlertRepository::class)
 */
class PostAlert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="postAlerts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $valid_for;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="postAlerts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $search_context;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getValidFor(): ?int
    {
        return $this->valid_for;
    }

    public function setValidFor(int $valid_for): self
    {
        $this->valid_for = $valid_for;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSearchContext(): ?string
    {
        return $this->search_context;
    }

    public function setSearchContext(?string $search_context): self
    {
        $this->search_context = $search_context;

        return $this;
    }
}
