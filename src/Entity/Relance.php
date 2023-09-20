<?php

namespace App\Entity;

use App\Repository\RelanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelanceRepository::class)]
class Relance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateRelance = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'relances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NatureRelances $nature = null;

    #[ORM\ManyToOne(inversedBy: 'relances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ModaliteContact $modalite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRelance(): ?\DateTimeInterface
    {
        return $this->dateRelance;
    }

    public function setDateRelance(\DateTimeInterface $dateRelance): static
    {
        $this->dateRelance = $dateRelance;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNature(): ?NatureRelances
    {
        return $this->nature;
    }

    public function setNature(?NatureRelances $nature): static
    {
        $this->nature = $nature;

        return $this;
    }

    public function getModalite(): ?ModaliteContact
    {
        return $this->modalite;
    }

    public function setModalite(?ModaliteContact $modalite): static
    {
        $this->modalite = $modalite;

        return $this;
    }
}
