<?php

namespace App\Entity;

use App\Repository\ModaliteContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModaliteContactRepository::class)]
class ModaliteContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Moyen = null;

    #[ORM\OneToMany(mappedBy: 'modalite', targetEntity: Relance::class, orphanRemoval: true)]
    private Collection $relances;

    public function __construct()
    {
        $this->relances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMoyen(): ?string
    {
        return $this->Moyen;
    }

    public function setMoyen(string $Moyen): static
    {
        $this->Moyen = $Moyen;

        return $this;
    }

    /**
     * @return Collection<int, Relance>
     */
    public function getRelances(): Collection
    {
        return $this->relances;
    }

    public function addRelance(Relance $relance): static
    {
        if (!$this->relances->contains($relance)) {
            $this->relances->add($relance);
            $relance->setModalite($this);
        }

        return $this;
    }

    public function removeRelance(Relance $relance): static
    {
        if ($this->relances->removeElement($relance)) {
            // set the owning side to null (unless already changed)
            if ($relance->getModalite() === $this) {
                $relance->setModalite(null);
            }
        }

        return $this;
    }
}
