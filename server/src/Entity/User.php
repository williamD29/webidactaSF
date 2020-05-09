<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"validation_groups"={"Default", "postValidation"}}
 *     },
 *     itemOperations={
 *         "delete",
 *         "get",
 *         "put"={"validation_groups"={"Default", "putValidation"}}
 *     }
 * )
 * @UniqueEntity("email", message="Un compte associé à cette adresse email existe déjà", groups={"postValidation", "putValidation"})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le prénom est requis", groups={"postValidation", "putValidation"})
     * @Assert\Regex(pattern="/^[a-zA-Z\u00C0-\u00FF' -]+$/", message="Le prénom contient un ou plusieurs caractères non valides", normalizer="trim", groups={"postValidation", "putValidation"})
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Le prénom doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le prénom doit contenir au maximum {{ limit }} caractères",
     *      allowEmptyString = false,
     *      groups={"postValidation", "putValidation"}
     * )
     * @ORM\Column(type="string", length=40)
     */
    private $firstname;

    /**
     * @Assert\NotBlank(message="Le nom est requis", groups={"postValidation", "putValidation"})
     * @Assert\Regex(pattern="/^[a-zA-Z\u00C0-\u00FF' -]+$/", message="Le nom contient un ou plusieurs caractères non valides", normalizer="trim", groups={"postValidation", "putValidation"})
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Le nom doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le nom doit contenir au maximum {{ limit }} caractères",
     *      allowEmptyString = false,
     *      groups={"postValidation", "putValidation"}
     * )
     * @ORM\Column(type="string", length=40)
     */
    private $lastname;

    /**
     * @Assert\NotBlank(message="L'adresse email est requise", groups={"postValidation", "putValidation"})
     * @Assert\Email(message="L'adresse email n'est pas valide", mode="html5", normalizer="trim", groups={"postValidation", "putValidation"})
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "L'adresse email doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "L'adresse email doit contenir au maximum {{ limit }} caractères",
     *      allowEmptyString = false,
     *      groups={"postValidation", "putValidation"}
     * )
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @Assert\NotBlank(message="Le mot de passe requis", groups={"postValidation", "putValidation"})
     * @Assert\Length(
     *      min = 8,
     *      max = 60,
     *      minMessage = "Le mot de passe doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le mot de passe doit contenir au maximum {{ limit }} caractères",
     *      allowEmptyString = false,
     *      groups={"postValidation", "putValidation"}
     * )
     * @ORM\Column(type="string", length=60)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profile_picture;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":"FALSE"})
     */
    private $is_admin;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="user_id")
     */
    private $student;

    /**
     * @ORM\OneToMany(targetEntity=Sheet::class, mappedBy="user_id")
     */
    private $sheet;

    public function __construct()
    {
        $this->student = new ArrayCollection();
        $this->sheet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(?string $profile_picture): self
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->is_admin;
    }

    public function setIsAdmin(bool $is_admin): self
    {
        $this->is_admin = $is_admin;

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
            $student->setUserId($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->student->contains($student)) {
            $this->student->removeElement($student);
            // set the owning side to null (unless already changed)
            if ($student->getUserId() === $this) {
                $student->setUserId(null);
            }
        }

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
            $sheet->setUserId($this);
        }

        return $this;
    }

    public function removeSheet(Sheet $sheet): self
    {
        if ($this->sheet->contains($sheet)) {
            $this->sheet->removeElement($sheet);
            // set the owning side to null (unless already changed)
            if ($sheet->getUserId() === $this) {
                $sheet->setUserId(null);
            }
        }

        return $this;
    }
}
