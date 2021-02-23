<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_date;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $post_title;

    /**
     * @ORM\Column(type="text")
     */
    private $post_detail;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_seller;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_individual;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $expected_price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_free;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_price_negotiable;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_renewed_on;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=PostImage::class, mappedBy="post")
     */
    private $postImages;

    /**
     * @ORM\OneToMany(targetEntity=PostAttribute::class, mappedBy="post")
     */
    private $postAttributes;

    public function __construct()
    {
        $this->postImages = new ArrayCollection();
        $this->postAttributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): self
    {
        $this->created_date = $created_date;

        return $this;
    }

    public function getPostTitle(): ?string
    {
        return $this->post_title;
    }

    public function setPostTitle(string $post_title): self
    {
        $this->post_title = $post_title;

        return $this;
    }

    public function getPostDetail(): ?string
    {
        return $this->post_detail;
    }

    public function setPostDetail(string $post_detail): self
    {
        $this->post_detail = $post_detail;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getIsSeller(): ?bool
    {
        return $this->is_seller;
    }

    public function setIsSeller(bool $is_seller): self
    {
        $this->is_seller = $is_seller;

        return $this;
    }

    public function getIsIndividual(): ?bool
    {
        return $this->is_individual;
    }

    public function setIsIndividual(bool $is_individual): self
    {
        $this->is_individual = $is_individual;

        return $this;
    }

    public function getExpectedPrice(): ?string
    {
        return $this->expected_price;
    }

    public function setExpectedPrice(?string $expected_price): self
    {
        $this->expected_price = $expected_price;

        return $this;
    }

    public function getIsFree(): ?bool
    {
        return $this->is_free;
    }

    public function setIsFree(bool $is_free): self
    {
        $this->is_free = $is_free;

        return $this;
    }

    public function getIsPriceNegotiable(): ?bool
    {
        return $this->is_price_negotiable;
    }

    public function setIsPriceNegotiable(bool $is_price_negotiable): self
    {
        $this->is_price_negotiable = $is_price_negotiable;

        return $this;
    }

    public function getLastRenewedOn(): ?\DateTimeInterface
    {
        return $this->last_renewed_on;
    }

    public function setLastRenewedOn(?\DateTimeInterface $last_renewed_on): self
    {
        $this->last_renewed_on = $last_renewed_on;

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

    /**
     * @return Collection|PostImage[]
     */
    public function getPostImages(): Collection
    {
        return $this->postImages;
    }

    public function addPostImage(PostImage $postImage): self
    {
        if (!$this->postImages->contains($postImage)) {
            $this->postImages[] = $postImage;
            $postImage->setPost($this);
        }

        return $this;
    }

    public function removePostImage(PostImage $postImage): self
    {
        if ($this->postImages->removeElement($postImage)) {
            // set the owning side to null (unless already changed)
            if ($postImage->getPost() === $this) {
                $postImage->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PostAttribute[]
     */
    public function getPostAttributes(): Collection
    {
        return $this->postAttributes;
    }

    public function addPostAttribute(PostAttribute $postAttribute): self
    {
        if (!$this->postAttributes->contains($postAttribute)) {
            $this->postAttributes[] = $postAttribute;
            $postAttribute->setPost($this);
        }

        return $this;
    }

    public function removePostAttribute(PostAttribute $postAttribute): self
    {
        if ($this->postAttributes->removeElement($postAttribute)) {
            // set the owning side to null (unless already changed)
            if ($postAttribute->getPost() === $this) {
                $postAttribute->setPost(null);
            }
        }

        return $this;
    }
}
