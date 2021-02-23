<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
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
    private $property_name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_mandatory;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="screen_control")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=ScreenControl::class, inversedBy="properties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $screen_control;

    /**
     * @ORM\Column(type="json")
     */
    private $possible_values = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropertyName(): ?string
    {
        return $this->property_name;
    }

    public function setPropertyName(string $property_name): self
    {
        $this->property_name = $property_name;

        return $this;
    }

    public function getIsMandatory(): ?bool
    {
        return $this->is_mandatory;
    }

    public function setIsMandatory(bool $is_mandatory): self
    {
        $this->is_mandatory = $is_mandatory;

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

    public function getScreenControl(): ?ScreenControl
    {
        return $this->screen_control;
    }

    public function setScreenControl(?ScreenControl $screen_control): self
    {
        $this->screen_control = $screen_control;

        return $this;
    }

    public function getPossibleValues(): ?array
    {
        return $this->possible_values;
    }

    public function setPossibleValues(array $possible_values): self
    {
        $this->possible_values = $possible_values;

        return $this;
    }
}
