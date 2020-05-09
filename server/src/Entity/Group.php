<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $group_number;

    /**
     * @ORM\OneToMany(targetEntity=Sheet::class, mappedBy="group_number")
     */
    private $sheet;

    /**
     * @ORM\OneToMany(targetEntity=Result::class, mappedBy="group_number")
     */
    private $result;

    public function __construct()
    {
        $this->sheet = new ArrayCollection();
        $this->result = new ArrayCollection();
    }

    public function getGroupNumber(): ?int
    {
        return $this->group_number;
    }

    public function setGroupNumber(int $group_number): self
    {
        $this->group_number = $group_number;

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
            $sheet->setGroupNumber($this);
        }

        return $this;
    }

    public function removeSheet(Sheet $sheet): self
    {
        if ($this->sheet->contains($sheet)) {
            $this->sheet->removeElement($sheet);
            // set the owning side to null (unless already changed)
            if ($sheet->getGroupNumber() === $this) {
                $sheet->setGroupNumber(null);
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
            $result->setGroupNumber($this);
        }

        return $this;
    }

    public function removeResult(Result $result): self
    {
        if ($this->result->contains($result)) {
            $this->result->removeElement($result);
            // set the owning side to null (unless already changed)
            if ($result->getGroupNumber() === $this) {
                $result->setGroupNumber(null);
            }
        }

        return $this;
    }
}
