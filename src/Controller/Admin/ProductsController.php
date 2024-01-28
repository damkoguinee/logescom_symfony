<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\ProductsRepository;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(ProductsRepository $productsRepository, EntrepriseRepository $entrepriseRep): Response
    {
        return $this->render('admin/products/index.html.twig', [
            'products' => $productsRepository->findBy([], ['categorie' => "ASC"]),
            'entreprise' => $entrepriseRep->find(1),
        ]);
    }

    /**
     * Méthode permettant de créer un nouveau produit
     */

    #[Route('/new', name: 'app_admin_products_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRep): Response
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash("success", "le produit a bien été crée ");
            return $this->redirectToRoute('app_admin_products_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/products/new.html.twig', [
            'product' => $product,
            'form' => $form,
            'productsForm'  => $form->createView(),
            'nameEntite'    =>'products',
            'entite'        =>$product,
            'entreprise' => $entrepriseRep->find(1),
        ]);
    }

    #[Route('/{id}', name: 'app_admin_products_show', methods: ['GET'])]
    public function show(Products $product, EntrepriseRepository $entrepriseRep): Response
    {
        return $this->render('admin/products/show.html.twig', [
            'product' => $product,
            'nameEntite'    =>'products',
            'entite'        =>$product,
            'entreprise' => $entrepriseRep->find(1),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_products_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Products $product, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRep): Response
    {
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_products_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/products/edit.html.twig', [
            'product' => $product,
            'form' => $form,
            'nameEntite'    =>'products',
            'entite'        =>$product,
            'productsForm'  => $form->createView(),
            'entreprise' => $entrepriseRep->find(1),
        ]);
    }

    #[Route('/{id}', name: 'app_admin_products_delete', methods: ['POST'])]
    public function delete(Request $request, Products $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_products_index', [], Response::HTTP_SEE_OTHER);
    }
}
