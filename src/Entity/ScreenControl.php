<?php

namespace App\Entity;

use App\Repository\ScreenControlRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScreenControlRepository::class)
 */
class ScreenControl
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $screen_control;

    /**
     * @ORM\OneToMany(targetEntity=Property::class, mappedBy="screen_control")
     */
    private $properties;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScreenControl(): ?string
    {
        return $this->screen_control;
    }

    public function setScreenControl(string $screen_control): self
    {
        $this->screen_control = $screen_control;

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
            $property->setScreenControl($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->properties->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getScreenControl() === $this) {
                $property->setScreenControl(null);
            }
        }

        return $this;
    }
}
