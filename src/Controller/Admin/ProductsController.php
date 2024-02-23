<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Entity\LiaisonProduit;
use App\Form\LiaisonProduitType;
use App\Repository\CategorieRepository;
use App\Repository\ProductsRepository;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LiaisonProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/products')]
class ProductsController extends AbstractController
{
    /**
     * Méthode permettant de renvoyer à la vue la liste des produits rangé par catégorie
     */
    #[Route('/', name: 'app_admin_products_index', methods: ['GET'])]
    public function index(ProductsRepository $productsRepository, EntrepriseRepository $entrepriseRep, Request $request): Response
    {
        if ($request->get("search")){
            $search = $request->get("search");

        }else{
            $search = "";
        }
        $pageEncours = $request->get('pageEncours', 1);
        $products = $productsRepository->findProductsAdminPaginated($search, $pageEncours, 20); 
        return $this->render('admin/products/index.html.twig', [
            'products' => $products,
            'entreprise' => $entrepriseRep->find(1),
        ]);
    }

    /**
     * Méthode permettant de créer un nouveau produit
     */

    #[Route('/new', name: 'app_admin_products_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategorieRepository $categorieRep, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRep, ProductsRepository $productsRep): Response
    {
        $categorie = $categorieRep->find($request->get('categorie', 1));
        $productDetail = new Products();
        $productPaquet = new Products();
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product, ['categorieId' => $categorie]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tva = ($form->getData()->getTva())/100;
            $product->setTva($tva);
            if ($form->getData()->getNbrePiece()) {
                $product->setCodeBarre(null);
                $productDetail->setReference(($form->getData()->getReference())."det");
                $productDetail->setDesignation(($form->getData()->getDesignation())." détail");
                $productDetail->setCategorie($form->getData()->getCategorie());
                $productDetail->setEpaisseur($form->getData()->getEpaisseur());
                $productDetail->setDimension($form->getData()->getDimension());
                $productDetail->setOrigine($form->getData()->getOrigine());
                $productDetail->setType($form->getData()->getType());
                $productDetail->setcodeBarre($form->getData()->getcodeBarre());
                $productDetail->setTypeProduit("detail");
                $productDetail->setStatut($form->getData()->getStatut());
                $productDetail->setStatutComptable($form->getData()->getStatutComptable());
                $productDetail->setTva($form->getData()->getTva());

                $liaisonProduit1 = new LiaisonProduit();
                $liaisonProduit1->setType("detail");
                $product->addLiaisonProduit1($liaisonProduit1);
                $productDetail->addLiaisonProduit2($liaisonProduit1);
            }

            if ($form->getData()->getNbrePaquet()) {
                $product->setCodeBarre(null);
                $productPaquet->setReference(($form->getData()->getReference())."paq");
                $productPaquet->setDesignation(($form->getData()->getDesignation())." paquet");
                $productPaquet->setCategorie($form->getData()->getCategorie());
                $productPaquet->setEpaisseur($form->getData()->getEpaisseur());
                $productPaquet->setDimension($form->getData()->getDimension());
                $productPaquet->setOrigine($form->getData()->getOrigine());
                $productPaquet->setType($form->getData()->getType());
                $productPaquet->setcodeBarre($form->getData()->getcodeBarre());
                $productPaquet->setTypeProduit("paquet");
                $productPaquet->setStatut($form->getData()->getStatut());
                $productPaquet->setStatutComptable($form->getData()->getStatutComptable());
                $productPaquet->setTva($form->getData()->getTva());

                $liaisonProduit2 = new LiaisonProduit();
                $liaisonProduit2->setType("paquet");
                $product->addLiaisonProduit1($liaisonProduit2);
                $productPaquet->addLiaisonProduit2($liaisonProduit2);
            }
            // dd($product->getTypeProduit());
            $entityManager->persist($product);
            if ($form->getData()->getNbrePaquet()) {
                $entityManager->persist($productPaquet);
            }
            if ($form->getData()->getNbrePiece()) {
                $entityManager->persist($productDetail);
            }
            $entityManager->flush();
            $product = new Products();
            $form = $this->createForm(ProductsType::class, $product, ['categorieId' => $categorie]); // on vide le formulaire
            $this->addFlash("success", "le produit a bien été crée ");
            // return $this->redirectToRoute('app_admin_products_new', ['categorie' => $categorie], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/products/new.html.twig', [
            'product' => $product,
            'form' => $form,
            'productsForm'  => $form->createView(),
            'nameEntite'    =>'products',
            'entite'        =>$product,
            'products' => $productsRep->findBy([], ['id' => "DESC"], 10),
            'categorieId' => $categorie,
            'entreprise' => $entrepriseRep->find(1),
        ]);
    }

    #[Route('/{id}', name: 'app_admin_products_show', methods: ['GET', 'POST'])]
    public function show(Products $product, Request $request, EntrepriseRepository $entrepriseRep, ProductsRepository $productsRep, LiaisonProduitRepository $liaisonProdRep, EntityManagerInterface $entityManager): Response
    {
        $liaisonProduit = new LiaisonProduit();
        $form = $this->createForm(LiaisonProduitType::class, $liaisonProduit,['productId' => $product]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $liaisonProduit->setProduit1($product);
            $type = $form->getData()->getProduit2()->getTypeProduit();
            $liaisonProduit->settype($type);
            $entityManager->persist($liaisonProduit);
            $entityManager->flush();
            $liaisonProduit = new LiaisonProduit();
        }
        
        $liasion_prod = $liaisonProdRep->findLiaisonByProduct($product);
        return $this->render('admin/products/show.html.twig', [
            'product' => $product,
            'nameEntite'    =>'products',
            'entite'        =>$product,
            'entreprise' => $entrepriseRep->find(1),
            // 'products' => $productsRep->findBy([], ['id' => "DESC"], 10),
            'liaisons' => $liasion_prod,

            'liaison_produit' => $liaisonProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_products_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Products $product, CategorieRepository $categorieRep, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRep): Response
    {

        $categorie = $categorieRep->find($product->getCategorie());
        $form = $this->createForm(ProductsType::class, $product, ['categorieId' => $categorie]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash("success", "le produit a bien été modifié ");
            return $this->redirectToRoute('app_admin_products_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/products/edit.html.twig', [
            'product' => $product,
            'form' => $form,
            'nameEntite'    =>'products',
            'entite'        =>$product,
            'productsForm'  => $form->createView(),
            'categorieId' => $categorie,
            'entreprise' => $entrepriseRep->find(1),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_admin_products_delete', methods: ['POST'])]
    public function delete(Request $request, Products $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_products_index', [], Response::HTTP_SEE_OTHER);
    }
}
