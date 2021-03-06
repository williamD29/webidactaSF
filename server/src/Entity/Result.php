<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ResultRepository;
use ApiPlatform\Core\Annotation\ApiResource;

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
     * @ORM\ManyToOne(targetEntity=GroupNumber::class, inversedBy="result")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupNumber;

    /**
     * @ORM\ManyToOne(targetEntity=SeriesNumber::class, inversedBy="result")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seriesNumber;

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
}
