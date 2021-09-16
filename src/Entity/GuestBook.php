<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GuestBookRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GuestBookRepository::class)
 */
class GuestBook
{

    const APPROVED_STATUS = 'approved';
    const PENDING_STATUS = 'pending';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank( message = "Guest Name cannot be blank", groups={"guestgroup"})
     * @Assert\Length(min=4,max=30,minMessage="Name should be minimum {{ limit }} characters",maxMessage="Name cannot exceeds {{ limit }} characters",groups={"guestgroup"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="guestBooks")
     */
    private $user;

    /**
     * @Assert\NotBlank( message = "Author cannot be blank", groups={"guestgroup"})
     * @Assert\Length(min=4,max=30,minMessage="Author should be minimum {{ limit }} characters",maxMessage="Author cannot exceeds {{ limit }} characters",groups={"guestgroup"})
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }
}
