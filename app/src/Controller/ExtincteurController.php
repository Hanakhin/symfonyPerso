<?php

namespace App\Controller;

use App\Entity\Extincteur;
use App\Form\ExtincteurTypeForm;
use App\Repository\ExtincteurRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/extincteur')]
class ExtincteurController extends AbstractController
{
    #[Route('/', name: 'app_extincteur_index', methods: ['GET'])]
    public function index(ExtincteurRepository $extincteurRepository, UserRepository $userRepository): Response
    {
        return $this->render('extincteur/index.html.twig', [
   
            'extincteurs' => $extincteurRepository->findAll()
            
        ]);
    }

    #[Route('/new', name: 'app_extincteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $extincteur = new Extincteur();
        $form = $this->createForm(ExtincteurTypeForm::class, $extincteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $extincteur->setActive(true);
            $entityManager->persist($extincteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_extincteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('extincteur/new.html.twig', [
            'extincteur' => $extincteur,
            'extincteurForm' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_extincteur_show', methods: ['GET'])]
    public function show(Extincteur $extincteur): Response
    {
        return $this->render('extincteur/show.html.twig', [
            'extincteur' => $extincteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_extincteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Extincteur $extincteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExtincteurTypeForm::class, $extincteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_extincteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('extincteur/edit.html.twig', [
            'extincteur' => $extincteur,
            'extincteurForm' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_extincteur_delete', methods: ['POST'])]
    public function delete(Request $request, Extincteur $extincteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$extincteur->getId(), $request->getPayload()->getString('_token'))) {
            $extincteur->setActive(false);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_extincteur_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/activate', name: 'app_extincteur_activate', methods: ['POST'])]
    public function activate(Request $request, Extincteur $extincteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('activate'.$extincteur->getId(), $request->getPayload()->getString('_token'))) {
            $extincteur->setActive(true);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_extincteur_index', [], Response::HTTP_SEE_OTHER);
    }


}
