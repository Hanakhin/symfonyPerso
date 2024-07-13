<?php

namespace App\Controller;

use App\Entity\Extincteur;
use App\Entity\Intervention;
use App\Entity\Status;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;


#[Route('/tech')]
class TechnicienController extends AbstractController
{
    #[Route('/index' ,name:'app_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $interventions = $entityManager->getRepository(Intervention::class)->findAll();
        $status = $entityManager->getRepository(Status::class)->findAll();
        $extincteurs = $entityManager->getRepository(Extincteur::class)->findAll();
        return $this->render('tech/index.html.twig', [
            'controller_name' => 'TechnicienController',
            'interventions'=>$interventions,
            'status'=>$status,
            'extincteurs'=>$extincteurs
        ]);
    }
}
