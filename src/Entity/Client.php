<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 50)]
    private ?string $typeClient = null;

    #[ORM\Column(length: 15)]
    private ?string $etat = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LieuxVentes $rattachement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTypeClient(): ?string
    {
        return $this->typeClient;
    }

    public function setTypeClient(string $typeClient): static
    {
        $this->typeClient = $typeClient;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getRattachement(): ?LieuxVentes
    {
        return $this->rattachement;
    }

    public function setRattachement(?LieuxVentes $rattachement): static
    {
        $this->rattachement = $rattachement;

        return $this;
    }
}
