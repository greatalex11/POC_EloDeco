<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    normalizationContext: ['groups' => ['client:read']],
    denormalizationContext: ['groups' => ['client:write']],
    order: ['nom' => 'DESC'],
)]
#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('client:read')]
    #[Assert\NotBlank()]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('client:read')]
    #[Assert\NotBlank()]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups('client:read')]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\ManyToMany(targetEntity: Mail::class, mappedBy: 'client')]
    #[Groups('client:read')]
    private Collection $mails;

    #[ORM\OneToOne(mappedBy: 'client', cascade: ['persist', 'remove'])]
    #[Assert\Valid]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Projet::class, inversedBy: 'clients')]
    private Collection $projets;

    public function __construct()
    {
        $this->mails = new ArrayCollection();
        $this->projets = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    #[client('read')]
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    #[client('read')]
    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * @return Collection<int, Mail>
     */

    public function getMails(): Collection
    {
        return $this->mails;
    }

    public function addMail(Mail $mail): static
    {
        if (!$this->mails->contains($mail)) {
            $this->mails->add($mail);
            $mail->addClient($this);
        }

        return $this;
    }

    public function removeMail(Mail $mail): static
    {
        if ($this->mails->removeElement($mail)) {
            $mail->removeClient($this);
        }

        return $this;
    }

    #[client('read')]
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getClient() !== $this) {
            $user->setClient($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    #[client('read')]
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function __toString(): string
    {
        return $this->nom . " " . $this->prenom;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        $this->projets->removeElement($projet);

        return $this;
    }
}
