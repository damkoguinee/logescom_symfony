<?php

namespace App\Controller\Admin;

use App\Entity\Epaisseurs;
use App\Form\EpaisseursType;
use App\Repository\EpaisseursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/epaisseurs')]
class EpaisseursController extends AbstractController
{
    #[Route('/', name: 'app_admin_epaisseurs_index', methods: ['GET'])]
    public function index(EpaisseursRepository $epaisseursRepository): Response
    {
        return $this->render('admin/epaisseurs/index.html.twig', [
            'epaisseurs' => $epaisseursRepository->findAll(),
            'nameEntite' => 'epaisseurs',
        ]);
    }

    #[Route('/new', name: 'app_admin_epaisseurs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $epaisseur = new Epaisseurs();
        $form = $this->createForm(EpaisseursType::class, $epaisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($epaisseur);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_epaisseurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/epaisseurs/new.html.twig', [
            'epaisseur' => $epaisseur,
            'form' => $form,
            'nameEntite' => 'epaisseurs',
            'entite' => $epaisseur,


        ]);
    }

    #[Route('/{id}', name: 'app_admin_epaisseurs_show', methods: ['GET'])]
    public function show(Epaisseurs $epaisseur): Response
    {
        return $this->render('admin/epaisseurs/show.html.twig', [
            'epaisseur' => $epaisseur,
            'nameEntite' => 'epaisseurs',
            'entite' => $epaisseur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_epaisseurs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Epaisseurs $epaisseur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EpaisseursType::class, $epaisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_epaisseurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/epaisseurs/edit.html.twig', [
            'epaisseur' => $epaisseur,
            'form' => $form,
            'nameEntite' => 'epaisseurs',
            'entite' => $epaisseur,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_epaisseurs_delete', methods: ['POST'])]
    public function delete(Request $request, Epaisseurs $epaisseur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$epaisseur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($epaisseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_epaisseurs_index', [], Response::HTTP_SEE_OTHER);
    }
}
