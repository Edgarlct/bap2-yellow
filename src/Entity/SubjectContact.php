<?php

namespace App\Entity;

use App\Repository\SubjectContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectContactRepository::class)]
class SubjectContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: RequestContact::class, orphanRemoval: true)]
    private $requestContacts;

    public function __construct()
    {
        $this->requestContacts = new ArrayCollection();
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
     * @return Collection<int, RequestContact>
     */
    public function getRequestContacts(): Collection
    {
        return $this->requestContacts;
    }

    public function addRequestContact(RequestContact $requestContact): self
    {
        if (!$this->requestContacts->contains($requestContact)) {
            $this->requestContacts[] = $requestContact;
            $requestContact->setSubject($this);
        }

        return $this;
    }

    public function removeRequestContact(RequestContact $requestContact): self
    {
        if ($this->requestContacts->removeElement($requestContact)) {
            // set the owning side to null (unless already changed)
            if ($requestContact->getSubject() === $this) {
                $requestContact->setSubject(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
