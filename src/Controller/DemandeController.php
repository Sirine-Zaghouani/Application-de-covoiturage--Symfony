<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/demande'),IsGranted('ROLE_ADMIN')]
class DemandeController extends AbstractController
{
   // #[Route('/', name: 'app_demande_index', methods: ['GET'])]
   // public function index(DemandeRepository $demandeRepository): Response
   // {
   //     return $this->render('demande/index.html.twig', [
    //        'demandes' => $demandeRepository->findAll(),
    //    ]);
    //}

   // #[Route('/new', name: 'app_demande_new', methods: ['GET', 'POST'])]
   // public function new(Request $request, DemandeRepository $demandeRepository): Response
   // {
   //     $demande = new Demande();
   //     $form = $this->createForm(DemandeType::class, $demande);
   //     $form->handleRequest($request);

   //     if ($form->isSubmitted() && $form->isValid()) {
   //         $demandeRepository->add($demande);
   //         return $this->redirectToRoute('app_demande_index', [], Response::HTTP_SEE_OTHER);
   //     }

    //    return $this->renderForm('demande/new.html.twig', [
     //       'demande' => $demande,
      //      'form' => $form,
     //   ]);
   // }

    #[Route('/{id}', name: 'app_demande_show', methods: ['GET']),IsGranted('ROLE_ADMIN')]
    public function show(Demande $demande): Response
    {
        return $this->render('demande/show.html.twig', [
            'demande' => $demande,
        ]);
    }

    //#[Route('/{id}/edit', name: 'app_demande_edit', methods: ['GET', 'POST'])]
    //public function edit(Request $request, Demande $demande, DemandeRepository $demandeRepository): Response
   // {
    //    $form = $this->createForm(DemandeType::class, $demande);
    //    $form->handleRequest($request);

    //    if ($form->isSubmitted() && $form->isValid()) {
    //        $demandeRepository->add($demande);
    //        return $this->redirectToRoute('app_demande_index', [], Response::HTTP_SEE_OTHER);
     //   }

     //   return $this->renderForm('demande/edit.html.twig', [
     //       'demande' => $demande,
     //       'form' => $form,
      //  ]);
   // }

    #[Route('/{id}', name: 'app_demande_delete', methods: ['POST']),IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Demande $demande, DemandeRepository $demandeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demande->getId(), $request->request->get('_token'))) {
            $demandeRepository->remove($demande);
        }

        return $this->redirectToRoute('demande', [], Response::HTTP_SEE_OTHER);
    }
}
