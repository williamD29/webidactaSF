<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SheetRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SheetRepository::class)
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
     * @ORM\ManyToOne(targetEntity=GroupNumber::class, inversedBy="sheet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupNumber;

    /**
     * @ORM\ManyToOne(targetEntity=SeriesNumber::class, inversedBy="sheet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seriesNumber;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sheet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\ManyToMany(targetEntity=Student::class, mappedBy="sheets")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="sheet")
     */
    private $question;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->question = new ArrayCollection();
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

    public function getGroupNumber(): ?GroupNumber
    {
        return $this->groupNumber;
    }

    public function setGroupNumber(?GroupNumber $groupNumber): self
    {
        $this->groupNumber = $groupNumber;

        return $this;
    }

    public function getSeriesNumber(): ?SeriesNumber
    {
        return $this->seriesNumber;
    }

    public function setSeriesNumber(?SeriesNumber $seriesNumber): self
    {
        $this->seriesNumber = $seriesNumber;

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

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->addSheet($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
            $student->removeSheet($this);
        }

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
            $question->setSheet($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->question->contains($question)) {
            $this->question->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getSheet() === $this) {
                $question->setSheet(null);
            }
        }

        return $this;
    }
}
