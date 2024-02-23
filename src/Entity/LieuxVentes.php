<?php

namespace App\Entity;

use App\Repository\LieuxVentesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuxVentesRepository::class)]
class LieuxVentes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lieuxVentes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $entreprise = null;

    #[ORM\ManyToOne(inversedBy: 'lieuxVentes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $gestionnaire = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 100)]
    private ?string $pays = null;

    #[ORM\Column(length: 100)]
    private ?string $region = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column(length: 20)]
    private ?string $telephone = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $longitude = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $initial = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeCommerce = null;

    #[ORM\OneToMany(mappedBy: 'lieuVente', targetEntity: ListeStock::class)]
    private Collection $listeStocks;

    #[ORM\OneToMany(mappedBy: 'lieuVente', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'lieuVente', targetEntity: ListeInventaire::class)]
    private Collection $listeInventaires;

    #[ORM\OneToMany(mappedBy: 'rattachement', targetEntity: Client::class)]
    private Collection $clients;

    #[ORM\OneToMany(mappedBy: 'lieuVente', targetEntity: MouvementProduct::class)]
    private Collection $mouvementProducts;

    public function __construct()
    {
        $this->listeStocks = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->listeInventaires = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->mouvementProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getGestionnaire(): ?User
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?User $gestionnaire): static
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getInitial(): ?string
    {
        return $this->initial;
    }

    public function setInitial(?string $initial): static
    {
        $this->initial = $initial;

        return $this;
    }

    public function getTypeCommerce(): ?string
    {
        return $this->typeCommerce;
    }

    public function setTypeCommerce(?string $typeCommerce): static
    {
        $this->typeCommerce = $typeCommerce;

        return $this;
    }

    /**
     * @return Collection<int, ListeStock>
     */
    public function getListeStocks(): Collection
    {
        return $this->listeStocks;
    }

    public function addListeStock(ListeStock $listeStock): static
    {
        if (!$this->listeStocks->contains($listeStock)) {
            $this->listeStocks->add($listeStock);
            $listeStock->setLieuVente($this);
        }

        return $this;
    }

    public function removeListeStock(ListeStock $listeStock): static
    {
        if ($this->listeStocks->removeElement($listeStock)) {
            // set the owning side to null (unless already changed)
            if ($listeStock->getLieuVente() === $this) {
                $listeStock->setLieuVente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setLieuVente($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getLieuVente() === $this) {
                $user->setLieuVente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ListeInventaire>
     */
    public function getListeInventaires(): Collection
    {
        return $this->listeInventaires;
    }

    public function addListeInventaire(ListeInventaire $listeInventaire): static
    {
        if (!$this->listeInventaires->contains($listeInventaire)) {
            $this->listeInventaires->add($listeInventaire);
            $listeInventaire->setLieuVente($this);
        }

        return $this;
    }

    public function removeListeInventaire(ListeInventaire $listeInventaire): static
    {
        if ($this->listeInventaires->removeElement($listeInventaire)) {
            // set the owning side to null (unless already changed)
            if ($listeInventaire->getLieuVente() === $this) {
                $listeInventaire->setLieuVente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): static
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->setRattachement($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getRattachement() === $this) {
                $client->setRattachement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MouvementProduct>
     */
    public function getMouvementProducts(): Collection
    {
        return $this->mouvementProducts;
    }

    public function addMouvementProduct(MouvementProduct $mouvementProduct): static
    {
        if (!$this->mouvementProducts->contains($mouvementProduct)) {
            $this->mouvementProducts->add($mouvementProduct);
            $mouvementProduct->setLieuVente($this);
        }

        return $this;
    }

    public function removeMouvementProduct(MouvementProduct $mouvementProduct): static
    {
        if ($this->mouvementProducts->removeElement($mouvementProduct)) {
            // set the owning side to null (unless already changed)
            if ($mouvementProduct->getLieuVente() === $this) {
                $mouvementProduct->setLieuVente(null);
            }
        }

        return $this;
    }
}
