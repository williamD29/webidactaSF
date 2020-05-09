<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $answer_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $answer_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $answer_3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_3;

    /**
     * @ORM\ManyToOne(targetEntity=Sheet::class, inversedBy="question")
     * @ORM\JoinColumn(name="sheet_id", nullable=false)
     */
    private $sheet_id;

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

    public function getAnswer1(): ?string
    {
        return $this->answer_1;
    }

    public function setAnswer1(?string $answer_1): self
    {
        $this->answer_1 = $answer_1;

        return $this;
    }

    public function getAnswer2(): ?string
    {
        return $this->answer_2;
    }

    public function setAnswer2(?string $answer_2): self
    {
        $this->answer_2 = $answer_2;

        return $this;
    }

    public function getAnswer3(): ?string
    {
        return $this->answer_3;
    }

    public function setAnswer3(?string $answer_3): self
    {
        $this->answer_3 = $answer_3;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image_1;
    }

    public function setImage1(?string $image_1): self
    {
        $this->image_1 = $image_1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image_2;
    }

    public function setImage2(?string $image_2): self
    {
        $this->image_2 = $image_2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image_3;
    }

    public function setImage3(?string $image_3): self
    {
        $this->image_3 = $image_3;

        return $this;
    }

    public function getSheetId(): ?Sheet
    {
        return $this->sheet_id;
    }

    public function setSheetId(?Sheet $sheet_id): self
    {
        $this->sheet_id = $sheet_id;

        return $this;
    }
}
