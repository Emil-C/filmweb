<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=ActorRepository::class)
 */
class Actor
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", unique=true)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    public function __construct(string $fName, string $lName)
    {
        $this->id = Uuid::uuid4();
        $this->fName = $fName;   
        $this->lName = $lName;   
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getFName(): ?string
    {
        return $this->fName;
    }

    // public function setFName(string $fName): self
    // {
    //     $this->fName = $fName;

    //     return $this;
    // }

    public function getLName(): ?string
    {
        return $this->lName;
    }

    // public function setLName(string $lName): self
    // {
    //     $this->lName = $lName;

    //     return $this;
    // }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }
}
