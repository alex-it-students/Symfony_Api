<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(nullable: true)]
    private ?int $AverageSize = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $Country = null;

    #[ORM\Column(nullable: true)]
    private ?int $AverageLifeExpectency = null;

    #[ORM\Column(length: 255)]
    private ?string $MartialArt = null;

    #[ORM\Column(length: 100)]
    private ?string $PhoneNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getAverageSize(): ?int
    {
        return $this->AverageSize;
    }

    public function setAverageSize(?int $AverageSize): self
    {
        $this->AverageSize = $AverageSize;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->Country;
    }

    public function setCountry(?Country $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getAverageLifeExpectency(): ?int
    {
        return $this->AverageLifeExpectency;
    }

    public function setAverageLifeExpectency(?int $AverageLifeExpectency): self
    {
        $this->AverageLifeExpectency = $AverageLifeExpectency;

        return $this;
    }

    public function getMartialArt(): ?string
    {
        return $this->MartialArt;
    }

    public function setMartialArt(string $MartialArt): self
    {
        $this->MartialArt = $MartialArt;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(string $PhoneNumber): self
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }
}
