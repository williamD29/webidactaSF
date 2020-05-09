<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SeriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SeriesRepository::class)
 */
class Series
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $series_number;

    /**
     * @ORM\OneToMany(targetEntity=Sheet::class, mappedBy="series_number")
     */
    private $sheet;

    /**
     * @ORM\OneToMany(targetEntity=Result::class, mappedBy="series_number")
     */
    private $result;

    public function __construct()
    {
        $this->sheet = new ArrayCollection();
        $this->result = new ArrayCollection();
    }

    public function getSeriesNumber(): ?int
    {
        return $this->series_number;
    }

    public function setSeriesNumber(int $series_number): self
    {
        $this->series_number = $series_number;

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
