<?php

namespace App\Entity;

use App\Repository\PostAttributeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostAttributeRepository::class)
 */
class PostAttribute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $post_attribute = [];

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="postAttributes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostAttribute(): ?array
    {
        return $this->post_attribute;
    }

    public function setPostAttribute(array $post_attribute): self
    {
        $this->post_attribute = $post_attribute;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }
}
