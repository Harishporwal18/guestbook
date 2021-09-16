<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{

    const ROLE_DEFAULT = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank( message = "Email cannot be blank", groups={"usergroup"})
     * @Assert\Length(min=4,max=30,minMessage="Email should be minimum {{ limit }} characters",maxMessage="Username cannot exceeds {{ limit }} characters",groups={"usergroup"})
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @Assert\NotBlank( message = "Password cannot be blank", groups={"usergroup"})
     * @Assert\Length(min=4,max=30,minMessage="Password should be minimum {{ limit }} characters",maxMessage="Password cannot exceeds {{ limit }} characters",groups={"usergroup"})
     * @ORM\Column(type="string")
     */
    private $password = '';

    /**
     * @ORM\OneToMany(targetEntity=GuestBook::class, mappedBy="user")
     */
    private $guestBooks;

    public function __construct()
    {
        $this->guestBooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(? string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
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
        return $this->password;
    }

    public function setPassword(? string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|GuestBook[]
     */
    public function getGuestBooks(): Collection
    {
        return $this->guestBooks;
    }

    public function addGuestBook(GuestBook $guestBook): self
    {
        if (!$this->guestBooks->contains($guestBook)) {
            $this->guestBooks[] = $guestBook;
            $guestBook->setUser($this);
        }

        return $this;
    }

    public function removeGuestBook(GuestBook $guestBook): self
    {
        if ($this->guestBooks->removeElement($guestBook)) {
            // set the owning side to null (unless already changed)
            if ($guestBook->getUser() === $this) {
                $guestBook->setUser(null);
            }
        }

        return $this;
    }
}
