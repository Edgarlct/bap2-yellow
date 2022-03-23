<?php

namespace App\Entity;

use App\Repository\PagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PagesRepository::class)]
class Pages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'page', targetEntity: SiteContent::class, orphanRemoval: true)]
    private $siteContents;

    public function __construct()
    {
        $this->siteContents = new ArrayCollection();
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
     * @return Collection<int, SiteContent>
     */
    public function getSiteContents(): Collection
    {
        return $this->siteContents;
    }

    public function addSiteContent(SiteContent $siteContent): self
    {
        if (!$this->siteContents->contains($siteContent)) {
            $this->siteContents[] = $siteContent;
            $siteContent->setPage($this);
        }

        return $this;
    }

    public function removeSiteContent(SiteContent $siteContent): self
    {
        if ($this->siteContents->removeElement($siteContent)) {
            // set the owning side to null (unless already changed)
            if ($siteContent->getPage() === $this) {
                $siteContent->setPage(null);
            }
        }

        return $this;
    }
}
