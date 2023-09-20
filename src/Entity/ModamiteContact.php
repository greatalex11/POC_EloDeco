<?php

namespace App\Entity;

use App\Repository\ModamiteContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModamiteContactRepository::class)]
class ModamiteContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'modamiteContacts')]
    private ?Mail $MailChoice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMailChoice(): ?Mail
    {
        return $this->MailChoice;
    }

    public function setMailChoice(?Mail $MailChoice): static
    {
        $this->MailChoice = $MailChoice;

        return $this;
    }
}
