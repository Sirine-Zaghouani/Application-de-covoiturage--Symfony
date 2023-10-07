<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\Annonce1Type;
use App\Repository\AnnonceRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/annonce' ),IsGranted('ROLE_ADMIN')]
class Annonce1Controller extends AbstractController
{


   // #[Route('/', name: 'app_annonce1_index', methods: ['GET'])]
   // public function index(Annonce1Repository $annonce1Repository): Response
   // {
    //    return $this->render('annonce1/index.html.twig', [
     //       'annonce1s' => $annonce1Repository->findAll(),
     //   ]);
   // }

    // #[Route('/new', name: 'app_annonce1_new', methods: ['GET', 'POST'])]
   // public function new(Request $request, Annonce1Repository $annonce1Repository): Response
   // {
    //    $annonce1 = new Annonce1();
    //    $form = $this->createForm(Annonce1Type::class, $annonce1);
     //   $form->handleRequest($request);

    //    if ($form->isSubmitted() && $form->isValid()) {
     //       $annonce1Repository->save($annonce1, true);

     //       return $this->redirectToRoute('app_annonce1_index', [], Response::HTTP_SEE_OTHER);
     //   }

    //    return $this->renderForm('annonce1/new.html.twig', [
    //        'annonce1' => $annonce1,
     //       'form' => $form,
     //   ]);
   // }

    #[Route('/{id}', name: 'app_annonce_show', methods: ['GET']),IsGranted('ROLE_ADMIN')]
    public function show(Annonce $annonce): Response
    {
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

   // #[Route('/{id}/edit', name: 'app_annonce1_edit', methods: ['GET', 'POST'])]
   // public function edit(Request $request, Annonce1 $annonce1, Annonce1Repository $annonce1Repository): Response
   // {
   //     $form = $this->createForm(Annonce1Type::class, $annonce1);
    //    $form->handleRequest($request);

    //    if ($form->isSubmitted() && $form->isValid()) {
    //        $annonce1Repository->save($annonce1, true);

     //       return $this->redirectToRoute('app_annonce1_index', [], Response::HTTP_SEE_OTHER);
     //   }

     //   return $this->renderForm('annonce1/edit.html.twig', [
    //        'annonce1' => $annonce1,
     //       'form' => $form,
    //    ]);
   // }

    #[Route('/{id}', name: 'app_annonce_delete', methods: ['POST']),IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Annonce $annonce, AnnonceRepository $annonceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $annonceRepository->remove($annonce, true);
        }

        return $this->redirectToRoute('annonce', [], Response::HTTP_SEE_OTHER);
    }
}
