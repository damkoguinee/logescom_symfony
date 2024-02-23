<?php

namespace App\Entity;

use App\Repository\ListeStockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeStockRepository::class)]
class ListeStock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'listeStocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LieuxVentes $lieuVente = null;

    #[ORM\Column(length: 150)]
    private ?string $nomStock = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(nullable: true)]
    private ?float $surface = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbrePieces = null;

    #[ORM\ManyToOne(inversedBy: 'listeStocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $responsable = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'stockProduit', targetEntity: Stock::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $stockProduit;

    #[ORM\OneToMany(mappedBy: 'stockProduct', targetEntity: MouvementProduct::class)]
    private Collection $mouvementProducts;

    #[ORM\OneToMany(mappedBy: 'stock', targetEntity: Inventaire::class)]
    private Collection $inventaires;

    #[ORM\OneToMany(mappedBy: 'stock', targetEntity: AnomalieProduit::class)]
    private Collection $anomalieProduits;

    public function __construct()
    {
        $this->stockProduit = new ArrayCollection();
        $this->mouvementProducts = new ArrayCollection();
        $this->inventaires = new ArrayCollection();
        $this->anomalieProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomStock(): ?string
    {
        return $this->nomStock;
    }

    public function setNomStock(string $nomStock): static
    {
        $this->nomStock = $nomStock;

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

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(?float $surface): static
    {
        $this->surface = $surface;

        return $this;
    }

    public function getNbrePieces(): ?int
    {
        return $this->nbrePieces;
    }

    public function setNbrePieces(?int $nbrePieces): static
    {
        $this->nbrePieces = $nbrePieces;

        return $this;
    }

    public function getResponsable(): ?User
    {
        return $this->responsable;
    }

    public function setResponsable(?User $responsable): static
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStockProduit(): Collection
    {
        return $this->stockProduit;
    }

    public function addStockProduit(Stock $stockProduit): static
    {
        if (!$this->stockProduit->contains($stockProduit)) {
            $this->stockProduit->add($stockProduit);
            $stockProduit->setStockProduit($this);
        }

        return $this;
    }

    public function removeStockProduit(Stock $stockProduit): static
    {
        if ($this->stockProduit->removeElement($stockProduit)) {
            // set the owning side to null (unless already changed)
            if ($stockProduit->getStockProduit() === $this) {
                $stockProduit->setStockProduit(null);
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
            $mouvementProduct->setStockProduct($this);
        }

        return $this;
    }

    public function removeMouvementProduct(MouvementProduct $mouvementProduct): static
    {
        if ($this->mouvementProducts->removeElement($mouvementProduct)) {
            // set the owning side to null (unless already changed)
            if ($mouvementProduct->getStockProduct() === $this) {
                $mouvementProduct->setStockProduct(null);
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
            $inventaire->setStock($this);
        }

        return $this;
    }

    public function removeInventaire(Inventaire $inventaire): static
    {
        if ($this->inventaires->removeElement($inventaire)) {
            // set the owning side to null (unless already changed)
            if ($inventaire->getStock() === $this) {
                $inventaire->setStock(null);
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
            $anomalieProduit->setStock($this);
        }

        return $this;
    }

    public function removeAnomalieProduit(AnomalieProduit $anomalieProduit): static
    {
        if ($this->anomalieProduits->removeElement($anomalieProduit)) {
            // set the owning side to null (unless already changed)
            if ($anomalieProduit->getStock() === $this) {
                $anomalieProduit->setStock(null);
            }
        }

        return $this;
    }
}
