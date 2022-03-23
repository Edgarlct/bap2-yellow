<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: BlogContent::class, orphanRemoval: true)]
    private $blogContents;

    public function __construct()
    {
        $this->blogContents = new ArrayCollection();
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
     * @return Collection<int, BlogContent>
     */
    public function getBlogContents(): Collection
    {
        return $this->blogContents;
    }

    public function addBlogContent(BlogContent $blogContent): self
    {
        if (!$this->blogContents->contains($blogContent)) {
            $this->blogContents[] = $blogContent;
            $blogContent->setCategory($this);
        }

        return $this;
    }

    public function removeBlogContent(BlogContent $blogContent): self
    {
        if ($this->blogContents->removeElement($blogContent)) {
            // set the owning side to null (unless already changed)
            if ($blogContent->getCategory() === $this) {
                $blogContent->setCategory(null);
            }
        }

        return $this;
    }
}
