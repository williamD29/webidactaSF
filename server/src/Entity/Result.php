<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ResultRepository::class)
 */
class Result
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $question_number;

    /**
     * @ORM\Column(type="integer")
     */
    private $answer_number;

    /**
     * @ORM\ManyToOne(targetEntity=Series::class, inversedBy="result")
     * @ORM\JoinColumn(name="series_number", referencedColumnName="series_number", nullable=false)
     */
    private $series_number;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="result")
     * @ORM\JoinColumn(name="group_number", referencedColumnName="group_number", nullable=false)
     */
    private $group_number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionNumber(): ?int
    {
        return $this->question_number;
    }

    public function setQuestionNumber(int $question_number): self
    {
        $this->question_number = $question_number;

        return $this;
    }

    public function getAnswerNumber(): ?int
    {
        return $this->answer_number;
    }

    public function setAnswerNumber(int $answer_number): self
    {
        $this->answer_number = $answer_number;

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
}
