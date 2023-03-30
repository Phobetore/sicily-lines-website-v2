<?php

namespace App\Controller;

use App\Entity\BateauCategorie;
use App\Form\BateauCategorieType;
use App\Repository\BateauCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bateau/categorie')]
class BateauCategorieController extends AbstractController
{
    #[Route('/', name: 'app_bateau_categorie_index', methods: ['GET'])]
    public function index(BateauCategorieRepository $bateauCategorieRepository): Response
    {
        return $this->render('bateau_categorie/index.html.twig', [
            'bateau_categories' => $bateauCategorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bateau_categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BateauCategorieRepository $bateauCategorieRepository): Response
    {
        $bateauCategorie = new BateauCategorie();
        $form = $this->createForm(BateauCategorieType::class, $bateauCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bateauCategorieRepository->save($bateauCategorie, true);

            return $this->redirectToRoute('app_bateau_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bateau_categorie/new.html.twig', [
            'bateau_categorie' => $bateauCategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bateau_categorie_show', methods: ['GET'])]
    public function show(BateauCategorie $bateauCategorie): Response
    {
        return $this->render('bateau_categorie/show.html.twig', [
            'bateau_categorie' => $bateauCategorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bateau_categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BateauCategorie $bateauCategorie, BateauCategorieRepository $bateauCategorieRepository): Response
    {
        $form = $this->createForm(BateauCategorieType::class, $bateauCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bateauCategorieRepository->save($bateauCategorie, true);

            return $this->redirectToRoute('app_bateau_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bateau_categorie/edit.html.twig', [
            'bateau_categorie' => $bateauCategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bateau_categorie_delete', methods: ['POST'])]
    public function delete(Request $request, BateauCategorie $bateauCategorie, BateauCategorieRepository $bateauCategorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bateauCategorie->getId(), $request->request->get('_token'))) {
            $bateauCategorieRepository->remove($bateauCategorie, true);
        }

        return $this->redirectToRoute('app_bateau_categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
