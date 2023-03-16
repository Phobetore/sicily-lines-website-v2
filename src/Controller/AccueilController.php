<?php

// src/Controller/AccueilController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        $number = random_int(0, 100);

        return $this->render('accueil/accueil.html.twig', [
            'number' => $number,
        ]);
    }
}