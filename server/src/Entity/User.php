<?php

namespace App\Entity;

use App\Validator\IsValidUser;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
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
 *         "put"={
 *             "validation_groups"={"Default", "putValidation"}
 *         },
 *         "patch"={
 *             "validation_groups"={"Default", "patchValidation"}
 *         }
 *     },
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}},
 *     attributes={
 *         "pagination_items_per_page"=1
 *     }
 * )
 * @UniqueEntity("email", message="Un compte associé à cette adresse email existe déjà", groups={"postValidation", "putValidation", "patchValidation"})
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ApiFilter(SearchFilter::class, properties={"firstname": "ipartial", "lastname": "ipartial", "email": "ipartial"})
 * @ApiFilter(PropertyFilter::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"admin:read"})
     * @IsValidUser()
     */
    private $id;

    /**
     * @Assert\Email(message="L'adresse email n'est pas valide", mode="html5", normalizer="trim", groups={"postValidation", "putValidation", "patchValidation"})
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "L'adresse email doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "L'adresse email doit contenir au maximum {{ limit }} caractères",
     *      allowEmptyString = false,
     *      groups={"postValidation", "putValidation", "patchValidation"}
     * )
     * @Assert\NotBlank(message="L'adresse email est requise", groups={"postValidation", "putValidation"})
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user:read", "user:write"})
     */
    private $email;

    /**
     * @Assert\Regex(pattern="/^[a-zA-Z\u00C0-\u00FF' -]+$/", message="Le prénom contient un ou plusieurs caractères non valides", normalizer="trim", groups={"postValidation", "putValidation", "patchValidation"})
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Le prénom doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le prénom doit contenir au maximum {{ limit }} caractères",
     *      allowEmptyString = false,
     *      groups={"postValidation", "putValidation", "patchValidation"}
     * )
     * @Assert\NotBlank(message="Le prénom est requis", groups={"postValidation", "putValidation"})
     * @ORM\Column(type="string", length=40)
     * @Groups({"user:read", "user:write"})
     */
    private $firstname;

    /**
     * @Assert\Regex(pattern="/^[a-zA-Z\u00C0-\u00FF' -]+$/", message="Le nom contient un ou plusieurs caractères non valides", normalizer="trim", groups={"postValidation", "putValidation", "patchValidation"})
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Le nom doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le nom doit contenir au maximum {{ limit }} caractères",
     *      allowEmptyString = false,
     *      groups={"postValidation", "putValidation", "patchValidation"}
     * )
     * @Assert\NotBlank(message="Le nom est requis", groups={"postValidation", "putValidation"})
     * @ORM\Column(type="string", length=40)
     * @Groups({"user:read", "user:write"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="json")
     * @Groups({"admin:read", "admin:write"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Assert\Length(
     *      min = 8,
     *      max = 60,
     *      minMessage = "Le mot de passe doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le mot de passe doit contenir au maximum {{ limit }} caractères",
     *      allowEmptyString = false,
     *      groups={"postValidation", "putValidation", "patchValidation"}
     * )
     * @Assert\NotBlank(message="Le mot de passe requis", groups={"postValidation", "putValidation"})
     * @SerializedName("password")
     * @Groups({"user:write"})
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $profilePicture;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="user_id")
     * @Groups({"admin:read", "admin:write"})
     */
    private $student;

    /**
     * @ORM\OneToMany(targetEntity=Sheet::class, mappedBy="user_id")
     * @Groups({"admin:read", "admin:write"})
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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

    public function getProfilePicture(): ?string
    {
        return (string) $this->profilePicture;
    }

    public function setProfilePicture(string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): string
    {
        return (string) $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
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
