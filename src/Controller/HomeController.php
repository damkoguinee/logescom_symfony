<?php

namespace App\Controller;

use App\Repository\BannieresEntrepriseRepository;
use App\Repository\CategorieRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntrepriseRepository $entrepriseRep, BannieresEntrepriseRepository $banniereRep, CategorieRepository $cateRep, ProductsRepository $productsRep): Response
    {
        $pageEncours = $request->get('pageEncours', 1);
        $categories = $cateRep->findCategoriesPaginated($pageEncours, 6); 
        $products = $productsRep->findProductsPaginated($pageEncours, 6); 
        $entreprise = $entrepriseRep->find(1);
        return $this->render('base.html.twig', [
            'entreprise' => $entreprise,
            'bannieres' => $banniereRep->findAll(),
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    #[Route('/detail/{id}', name: 'app_home_detail_produit')]
    public function productDetail(): Response
    {
        return $this->render('home/product_detail.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
