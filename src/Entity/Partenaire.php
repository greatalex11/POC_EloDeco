<?php

namespace App\Entity;

use App\Repository\PartenaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PartenaireRepository::class)]
class Partenaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank()]
    private ?string $entreprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $raison_sociale = null;

    #[ORM\Column(nullable: true)]
    private ?int $siret = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_contact = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom_contact = null;

    #[ORM\ManyToMany(targetEntity: Projet::class, mappedBy: 'artisans')]
    private Collection $projets;

    #[ORM\ManyToMany(targetEntity: Mail::class, mappedBy: 'partenaire')]
    private Collection $mails;

    #[ORM\OneToOne(mappedBy: 'partenaire', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Taches::class, mappedBy: 'entreprise')]
    private Collection $taches;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
        $this->mails = new ArrayCollection();
        $this->taches = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->entreprise;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raison_sociale;
    }

    public function setRaisonSociale(string $raison_sociale): static
    {
        $this->raison_sociale = $raison_sociale;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNomContact(): ?string
    {
        return $this->nom_contact;
    }

    public function setNomContact(string $nom_contact): static
    {
        $this->nom_contact = $nom_contact;

        return $this;
    }

    public function getPrenomContact(): ?string
    {
        return $this->prenom_contact;
    }

    public function setPrenomContact(string $prenom_contact): static
    {
        $this->prenom_contact = $prenom_contact;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->addArtisan($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            $projet->removeArtisan($this);
        }

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
            $mail->addPartenaire($this);
        }

        return $this;
    }

    public function removeMail(Mail $mail): static
    {
        if ($this->mails->removeElement($mail)) {
            $mail->removePartenaire($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setPartenaire(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getPartenaire() !== $this) {
            $user->setPartenaire($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Taches>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Taches $tach): static
    {
        if (!$this->taches->contains($tach)) {
            $this->taches->add($tach);
            $tach->addEntreprise($this);
        }

        return $this;
    }

    public function removeTach(Taches $tach): static
    {
        if ($this->taches->removeElement($tach)) {
            $tach->removeEntreprise($this);
        }

        return $this;
    }
}
