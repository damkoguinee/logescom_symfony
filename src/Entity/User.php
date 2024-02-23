<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 150)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'gestionnaire', targetEntity: LieuxVentes::class)]
    private Collection $lieuxVentes;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'responsable', targetEntity: ListeStock::class)]
    private Collection $listeStocks;

    #[ORM\Column(length: 15, nullable: false)]
    private ?string $typeUser = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: false)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Personnel::class, cascade: ['persist'])]
    private Collection $personnels;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Client::class)]
    private Collection $clients;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LieuxVentes $lieuVente = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $adresse = null;

    #[ORM\Column(length: 100, nullable: false)]
    private ?string $ville = null;

    #[ORM\Column(length: 100, nullable: false)]
    private ?string $region = null;

    #[ORM\Column(length: 100, nullable: false)]
    private ?string $pays = null;

    #[ORM\Column(length: 10)]
    private ?string $statut = null;

    #[ORM\OneToMany(mappedBy: 'personnel', targetEntity: ListeInventaire::class)]
    private Collection $listeInventaires;

    #[ORM\OneToMany(mappedBy: 'personnel', targetEntity: Inventaire::class)]
    private Collection $inventaires;

    #[ORM\OneToMany(mappedBy: 'personnel', targetEntity: MouvementProduct::class)]
    private Collection $mouvementProducts;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: MouvementProduct::class)]
    private Collection $mouvementProductsClient;

    #[ORM\OneToMany(mappedBy: 'personnel', targetEntity: AnomalieProduit::class)]
    private Collection $anomalieProduits;

    public function __construct()
    {
        $this->lieuxVentes = new ArrayCollection();
        $this->listeStocks = new ArrayCollection();
        $this->personnels = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->listeInventaires = new ArrayCollection();
        $this->inventaires = new ArrayCollection();
        $this->mouvementProducts = new ArrayCollection();
        $this->mouvementProductsClient = new ArrayCollection();
        $this->anomalieProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        // Vérifie si le mot de passe est null, si c'est le cas, retourne une chaîne vide
        if ($this->password === null) {
            return '';
        }
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, LieuxVentes>
     */
    public function getLieuxVentes(): Collection
    {
        return $this->lieuxVentes;
    }

    public function addLieuxVente(LieuxVentes $lieuxVente): static
    {
        if (!$this->lieuxVentes->contains($lieuxVente)) {
            $this->lieuxVentes->add($lieuxVente);
            $lieuxVente->setGestionnaire($this);
        }

        return $this;
    }

    public function removeLieuxVente(LieuxVentes $lieuxVente): static
    {
        if ($this->lieuxVentes->removeElement($lieuxVente)) {
            // set the owning side to null (unless already changed)
            if ($lieuxVente->getGestionnaire() === $this) {
                $lieuxVente->setGestionnaire(null);
            }
        }

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
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
            $listeStock->setResponsable($this);
        }

        return $this;
    }

    public function removeListeStock(ListeStock $listeStock): static
    {
        if ($this->listeStocks->removeElement($listeStock)) {
            // set the owning side to null (unless already changed)
            if ($listeStock->getResponsable() === $this) {
                $listeStock->setResponsable(null);
            }
        }

        return $this;
    }

    public function getTypeUser(): ?string
    {
        return $this->typeUser;
    }

    public function setTypeUser(?string $typeUser): static
    {
        $this->typeUser = $typeUser;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, Personnel>
     */
    public function getPersonnels(): Collection
    {
        return $this->personnels;
    }

    public function addPersonnel(Personnel $personnel): static
    {
        if (!$this->personnels->contains($personnel)) {
            $this->personnels->add($personnel);
            $personnel->setUser($this);
        }

        return $this;
    }

    public function removePersonnel(Personnel $personnel): static
    {
        if ($this->personnels->removeElement($personnel)) {
            // set the owning side to null (unless already changed)
            if ($personnel->getUser() === $this) {
                $personnel->setUser(null);
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
            $client->setUser($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getUser() === $this) {
                $client->setUser(null);
            }
        }

        return $this;
    }

    public function getLieuVente(): ?LieuxVentes
    {
        return $this->lieuVente;
    }

    public function setLieuVente(?LieuxVentes $lieuVente): static
    {
        $this->lieuVente = $lieuVente;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

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

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

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
            $listeInventaire->setPersonnel($this);
        }

        return $this;
    }

    public function removeListeInventaire(ListeInventaire $listeInventaire): static
    {
        if ($this->listeInventaires->removeElement($listeInventaire)) {
            // set the owning side to null (unless already changed)
            if ($listeInventaire->getPersonnel() === $this) {
                $listeInventaire->setPersonnel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inventaire>
     */
    public function getInventaires(): Collection
    {
        return $this->inventaires;
    }

    public function addInventaire(Inventaire $inventaire): static
    {
        if (!$this->inventaires->contains($inventaire)) {
            $this->inventaires->add($inventaire);
            $inventaire->setPersonnel($this);
        }

        return $this;
    }

    public function removeInventaire(Inventaire $inventaire): static
    {
        if ($this->inventaires->removeElement($inventaire)) {
            // set the owning side to null (unless already changed)
            if ($inventaire->getPersonnel() === $this) {
                $inventaire->setPersonnel(null);
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
            $mouvementProduct->setPersonnel($this);
        }

        return $this;
    }

    public function removeMouvementProduct(MouvementProduct $mouvementProduct): static
    {
        if ($this->mouvementProducts->removeElement($mouvementProduct)) {
            // set the owning side to null (unless already changed)
            if ($mouvementProduct->getPersonnel() === $this) {
                $mouvementProduct->setPersonnel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MouvementProduct>
     */
    public function getMouvementProductsClient(): Collection
    {
        return $this->mouvementProductsClient;
    }

    public function addMouvementProductsClient(MouvementProduct $mouvementProductsClient): static
    {
        if (!$this->mouvementProductsClient->contains($mouvementProductsClient)) {
            $this->mouvementProductsClient->add($mouvementProductsClient);
            $mouvementProductsClient->setClient($this);
        }

        return $this;
    }

    public function removeMouvementProductsClient(MouvementProduct $mouvementProductsClient): static
    {
        if ($this->mouvementProductsClient->removeElement($mouvementProductsClient)) {
            // set the owning side to null (unless already changed)
            if ($mouvementProductsClient->getClient() === $this) {
                $mouvementProductsClient->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AnomalieProduit>
     */
    public function getAnomalieProduits(): Collection
    {
        return $this->anomalieProduits;
    }

    public function addAnomalieProduit(AnomalieProduit $anomalieProduit): static
    {
        if (!$this->anomalieProduits->contains($anomalieProduit)) {
            $this->anomalieProduits->add($anomalieProduit);
            $anomalieProduit->setPersonnel($this);
        }

        return $this;
    }

    public function removeAnomalieProduit(AnomalieProduit $anomalieProduit): static
    {
        if ($this->anomalieProduits->removeElement($anomalieProduit)) {
            // set the owning side to null (unless already changed)
            if ($anomalieProduit->getPersonnel() === $this) {
                $anomalieProduit->setPersonnel(null);
            }
        }

        return $this;
    }
}
