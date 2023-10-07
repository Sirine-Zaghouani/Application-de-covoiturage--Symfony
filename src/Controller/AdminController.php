<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;

use App\Repository\DemandeRepository;
use App\Repository\UserRepository;
use App\Repository\AnnonceRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', ['users' => $userRepository->findAll() ]);
    }

    #[Route('/annonce', name: 'annonce')]
    public function index2(AnnonceRepository $annonceRepository): Response
    {
        return $this->render('annonce/index.html.twig', ['annonces' => $annonceRepository->findAll() ]);
    }

    #[Route('/demande', name: 'demande')]
    public function index3(DemandeRepository  $demandeRepository): Response
    {
        return $this->render('demande/index.html.twig', ['demandes' => $demandeRepository->findAll() ]);
    }
}
