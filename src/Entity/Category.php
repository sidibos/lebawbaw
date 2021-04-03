<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $category_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maximum_images_allowed;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="categories")
     */
    private $parent_category;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, mappedBy="parent_category")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="category")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity=Property::class, mappedBy="category")
     */
    private $properties;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $post_validity_interval_in_days;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="subCategories")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="parent")
     */
    private $subCategories;

    /**
     * @ORM\OneToMany(targetEntity=PostAlert::class, mappedBy="category")
     */
    private $postAlerts;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $categorySlug;

    public function __construct()
    {
        $this->parent_category = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->properties = new ArrayCollection();
        $this->subCategories = new ArrayCollection();
        $this->postAlerts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }

    public function setCategoryName(string $category_name): self
    {
        $this->category_name = $category_name;

        return $this;
    }

    public function getMaximumImagesAllowed(): ?int
    {
        return $this->maximum_images_allowed;
    }

    public function setMaximumImagesAllowed(?int $maximum_images_allowed): self
    {
        $this->maximum_images_allowed = $maximum_images_allowed;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getParentCategory(): Collection
    {
        return $this->parent_category;
    }

    public function addParentCategory(self $parentCategory): self
    {
        if (!$this->parent_category->contains($parentCategory)) {
            $this->parent_category[] = $parentCategory;
        }

        return $this;
    }

    public function removeParentCategory(self $parentCategory): self
    {
        $this->parent_category->removeElement($parentCategory);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addParentCategory($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeParentCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setCategory($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getCategory() === $this) {
                $post->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Property[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setCategory($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->properties->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getCategory() === $this) {
                $property->setCategory(null);
            }
        }

        return $this;
    }

    public function getPostValidityIntervalInDays(): ?int
    {
        return $this->post_validity_interval_in_days;
    }

    public function setPostValidityIntervalInDays(?int $post_validity_interval_in_days): self
    {
        $this->post_validity_interval_in_days = $post_validity_interval_in_days;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSubCategories(): Collection
    {
        return $this->subCategories;
    }

    public function addSubCategory(self $subCategory): self
    {
        if (!$this->subCategories->contains($subCategory)) {
            $this->subCategories[] = $subCategory;
            $subCategory->setParent($this);
        }

        return $this;
    }

    public function removeSubCategory(self $subCategory): self
    {
        if ($this->subCategories->removeElement($subCategory)) {
            // set the owning side to null (unless already changed)
            if ($subCategory->getParent() === $this) {
                $subCategory->setParent(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->category_name;
    }

    /**
     * @return Collection|PostAlert[]
     */
    public function getPostAlerts(): Collection
    {
        return $this->postAlerts;
    }

    public function addPostAlert(PostAlert $postAlert): self
    {
        if (!$this->postAlerts->contains($postAlert)) {
            $this->postAlerts[] = $postAlert;
            $postAlert->setCategory($this);
        }

        return $this;
    }

    public function removePostAlert(PostAlert $postAlert): self
    {
        if ($this->postAlerts->removeElement($postAlert)) {
            // set the owning side to null (unless already changed)
            if ($postAlert->getCategory() === $this) {
                $postAlert->setCategory(null);
            }
        }

        return $this;
    }

    public function getCategorySlug(): ?string
    {
        return $this->categorySlug;
    }

    public function setCategorySlug(string $categorySlug): self
    {
        $this->categorySlug = $categorySlug;

        return $this;
    }
}
