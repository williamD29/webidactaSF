<?php

namespace App\Entity;

use App\Repository\SeriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeriesRepository::class)
 */
class Series
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Sheet::class, mappedBy="series")
     */
    private $sheet;

    /**
     * @ORM\OneToMany(targetEntity=Result::class, mappedBy="series")
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
            $sheet->setSeries($this);
        }

        return $this;
    }

    public function removeSheet(Sheet $sheet): self
    {
        if ($this->sheet->contains($sheet)) {
            $this->sheet->removeElement($sheet);
            // set the owning side to null (unless already changed)
            if ($sheet->getSeries() === $this) {
                $sheet->setSeries(null);
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
            $result->setSeries($this);
        }

        return $this;
    }

    public function removeResult(Result $result): self
    {
        if ($this->result->contains($result)) {
            $this->result->removeElement($result);
            // set the owning side to null (unless already changed)
            if ($result->getSeries() === $this) {
                $result->setSeries(null);
            }
        }

        return $this;
    }
}
