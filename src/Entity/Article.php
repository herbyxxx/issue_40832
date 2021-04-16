<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"article"="Article", "subarticle"="SubArticle"})
 */
class Article
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @ORM\OneToMany(targetEntity=ArticleTranslation::class, mappedBy="content", cascade={"persist"}, orphanRemoval=true)
     * @Assert\Valid
     */
    private $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPublishedAt(): ?\DateTime
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTime $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return Collection|ArticleTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(ArticleTranslation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setArticle($this);
        }

        return $this;
    }

    public function removeTranslation(ArticleTranslation $translation): self
    {
        if ($this->translations->removeElement($translation)) {
            // set the owning side to null (unless already changed)
            if ($translation->getArticle() === $this) {
                $translation->setArticle(null);
            }
        }

        return $this;
    }
}