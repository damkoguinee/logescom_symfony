<?php

namespace App\Controller\Logescom;

use App\Entity\Entreprise;
use App\Entity\LieuxVentes;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LieuxVentesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/logescom/home', name: 'app_logescom_home')]
    public function index(EntrepriseRepository $entrepriseRep, LieuxVentesRepository $lieuxVentesRep): Response
    {
        $user = $this->getUser();
        if ($this->isGranted('ROLE_ADMIN') or $this->isGranted('ROLE_DEVELOPPEUR') || $this->isGranted('ROLE_RESPONSABLE')) { 
            $lieux_ventes = $lieuxVentesRep->findAll();
        } else {
            $lieux_ventes = $lieuxVentesRep->findBy(['id' => $user->getLieuVente()->getId()]);
        }
        return $this->render('logescom/home/index.html.twig', [
            'entreprise' => $entrepriseRep->find(1),
            'lieux_ventes' => $lieux_ventes,
        ]);
    }

    #[Route('/lieuvente/{id}', name: 'app_logescom_home-lieuvente', methods: ['GET', 'POST'])]
    public function homeLieuVente(LieuxVentes $lieuxVentes, Request $request, EntrepriseRepository $entrepriseRep, EntityManagerInterface $entityManager): Response
    {
        return $this->render('logescom/home/choix.html.twig', [
            'entreprise' => $entrepriseRep->find(1),
            'lieu_vente' => $lieuxVentes,
        ]);
    }
}
