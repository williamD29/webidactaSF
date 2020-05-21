<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SeriesNumberRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SeriesNumberRepository::class)
 */
class SeriesNumber
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Sheet::class, mappedBy="seriesNumber")
     */
    private $sheet;

    /**
     * @ORM\OneToMany(targetEntity=Result::class, mappedBy="seriesNumber")
     */
    private $result;

    public function __construct()
    {
        $this->sheet = new ArrayCollection();
        $this->result = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection|Sheet[]
     */
    public function getSheet(): Collection
    {
        return $this->sheet;
    }

    public function addSheet(Sheet $sheet): self
    {
        if (!$this->sheet->contains($sheet)) {
            $this->sheet[] = $sheet;
            $sheet->setSeriesNumber($this);
        }

        return $this;
    }

    public function removeSheet(Sheet $sheet): self
    {
        if ($this->sheet->contains($sheet)) {
            $this->sheet->removeElement($sheet);
            // set the owning side to null (unless already changed)
            if ($sheet->getSeriesNumber() === $this) {
                $sheet->setSeriesNumber(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Result[]
     */
    public function getResult(): Collection
    {
        return $this->result;
    }

    public function addResult(Result $result): self
    {
        if (!$this->result->contains($result)) {
            $this->result[] = $result;
            $result->setSeriesNumber($this);
        }

        return $this;
    }

    public function removeResult(Result $result): self
    {
        if ($this->result->contains($result)) {
            $this->result->removeElement($result);
            // set the owning side to null (unless already changed)
            if ($result->getSeriesNumber() === $this) {
                $result->setSeriesNumber(null);
            }
        }

        return $this;
    }
}
