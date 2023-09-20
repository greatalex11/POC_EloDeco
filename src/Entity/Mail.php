<?php

namespace App\Entity;

use App\Repository\MailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MailRepository::class)]
class Mail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $objet = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $corps = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateExpe = null;

    #[ORM\ManyToMany(targetEntity: Client::class, inversedBy: 'mails')]
    private Collection $client;

    #[ORM\ManyToMany(targetEntity: Partenaire::class, inversedBy: 'mails')]
    private Collection $partenaire;

    #[ORM\OneToMany(mappedBy: 'MailChoice', targetEntity: ModamiteContact::class)]
    private Collection $modamiteContacts;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pieceJointe = null;

    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->partenaire = new ArrayCollection();
        $this->modamiteContacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): static
    {
        $this->objet = $objet;

        return $this;
    }

    public function getCorps(): ?string
    {
        return $this->corps;
    }

    public function setCorps(string $corps): static
    {
        $this->corps = $corps;

        return $this;
    }

    public function getDateExpe(): ?\DateTimeInterface
    {
        return $this->dateExpe;
    }

    public function setDateExpe(?\DateTimeInterface $dateExpe): static
    {
        $this->dateExpe = $dateExpe;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Client $client): static
    {
        if (!$this->client->contains($client)) {
            $this->client->add($client);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        $this->client->removeElement($client);

        return $this;
    }

    /**
     * @return Collection<int, Partenaire>
     */
    public function getPartenaire(): Collection
    {
        return $this->partenaire;
    }

    public function addPartenaire(Partenaire $partenaire): static
    {
        if (!$this->partenaire->contains($partenaire)) {
            $this->partenaire->add($partenaire);
        }

        return $this;
    }

    public function removePartenaire(Partenaire $partenaire): static
    {
        $this->partenaire->removeElement($partenaire);

        return $this;
    }

    /**
     * @return Collection<int, ModamiteContact>
     */
    public function getModamiteContacts(): Collection
    {
        return $this->modamiteContacts;
    }

    public function addModamiteContact(ModamiteContact $modamiteContact): static
    {
        if (!$this->modamiteContacts->contains($modamiteContact)) {
            $this->modamiteContacts->add($modamiteContact);
            $modamiteContact->setMailChoice($this);
        }

        return $this;
    }

    public function removeModamiteContact(ModamiteContact $modamiteContact): static
    {
        if ($this->modamiteContacts->removeElement($modamiteContact)) {
            // set the owning side to null (unless already changed)
            if ($modamiteContact->getMailChoice() === $this) {
                $modamiteContact->setMailChoice(null);
            }
        }

        return $this;
    }

    public function getPieceJointe(): ?string
    {
        return $this->pieceJointe;
    }

    public function setPieceJointe(?string $pieceJointe): static
    {
        $this->pieceJointe = $pieceJointe;

        return $this;
    }
}
