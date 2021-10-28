<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 */
class News
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $modified_at;

    /**
     * @ORM\Column(type="blob")
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity=NewsPhoto::class, mappedBy="news", orphanRemoval=true, cascade={"persist"})
     */
    private $newsPhotos;

    public function __construct()
    {
        $this->newsPhotos = new ArrayCollection();
        $this->setCreatedAt(new \DateTimeImmutable(date('Y-m-d H:i:s')));
        $this->setModifiedAt(new \DateTimeImmutable(date('Y-m-d H:i:s')));
    }

    /**
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setModifiedAt(new \DateTimeImmutable(date('Y-m-d H:i:s')));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->modified_at;
    }

    public function setModifiedAt(\DateTimeImmutable $modified_at): self
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|NewsPhoto[]
     */
    public function getNewsPhotos(): Collection
    {
        return $this->newsPhotos;
    }

    public function addNewsPhoto(NewsPhoto $newsPhoto): self
    {
        if (!$this->newsPhotos->contains($newsPhoto)) {
            $this->newsPhotos[] = $newsPhoto;
            $newsPhoto->setNews($this);
        }

        return $this;
    }

    public function removeNewsPhoto(NewsPhoto $newsPhoto): self
    {
        if ($this->newsPhotos->removeElement($newsPhoto)) {
            // set the owning side to null (unless already changed)
            if ($newsPhoto->getNews() === $this) {
                $newsPhoto->setNews(null);
            }
        }

        return $this;
    }
}
