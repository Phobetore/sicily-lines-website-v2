<?php

namespace App\Controller;

use App\Entity\Traversee;
use App\Repository\TraverseeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(TraverseeRepository $traverseeRepository): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'traversees' => $traverseeRepository->findAll(),
        ]);
    }
}
