<?php

namespace App\Entity;

use App\Repository\SocialTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocialTypeRepository::class)]
class SocialType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Social::class, orphanRemoval: true)]
    private $socials;

    public function __construct()
    {
        $this->socials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Social>
     */
    public function getSocials(): Collection
    {
        return $this->socials;
    }

    public function addSocial(Social $social): self
    {
        if (!$this->socials->contains($social)) {
            $this->socials[] = $social;
            $social->setType($this);
        }

        return $this;
    }

    public function removeSocial(Social $social): self
    {
        if ($this->socials->removeElement($social)) {
            // set the owning side to null (unless already changed)
            if ($social->getType() === $this) {
                $social->setType(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
