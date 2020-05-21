<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SheetRepository;
use Doctrine\ORM\Mapping\EntityListeners;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SheetRepository::class)
 * @ORM\EntityListeners({"App\Doctrine\SheetSetOwnerListener"})
 */
class Sheet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $global_question;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sheet")
     * @ORM\JoinColumn(name="user_id", nullable=false)
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=Series::class, inversedBy="sheet")
     * @ORM\JoinColumn(name="series_number", referencedColumnName="series_number", nullable=false)
     */
    private $series_number;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="sheet")
     * @ORM\JoinColumn(name="group_number", referencedColumnName="group_number", nullable=false)
     */
    private $group_number;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="sheet_id")
     */
    private $question;

    /**
     * @ORM\ManyToMany(targetEntity=Student::class, inversedBy="sheets")
     */
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity=Series::class, inversedBy="sheet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $series;

    public function __construct()
    {
        $this->question = new ArrayCollection();
        $this->student = new ArrayCollection();
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

    public function getGlobalQuestion(): ?string
    {
        return $this->global_question;
    }

    public function setGlobalQuestion(string $global_question): self
    {
        $this->global_question = $global_question;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getSeriesNumber(): ?Series
    {
        return $this->series_number;
    }

    public function setSeriesNumber(?Series $series_number): self
    {
        $this->series_number = $series_number;

        return $this;
    }

    public function getGroupNumber(): ?Group
    {
        return $this->group_number;
    }

    public function setGroupNumber(?Group $group_number): self
    {
        $this->group_number = $group_number;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestion(): Collection
    {
        return $this->question;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->question->contains($question)) {
            $this->question[] = $question;
            $question->setSheetId($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->question->contains($question)) {
            $this->question->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getSheetId() === $this) {
                $question->setSheetId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudent(): Collection
    {
        return $this->student;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->student->contains($student)) {
            $this->student[] = $student;
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->student->contains($student)) {
            $this->student->removeElement($student);
        }

        return $this;
    }

    public function getSeries(): ?Series
    {
        return $this->series;
    }

    public function setSeries(?Series $series): self
    {
        $this->series = $series;

        return $this;
    }
}
