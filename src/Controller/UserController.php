<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin'),IsGranted('ROLE_ADMIN')]
class UserController extends AbstractController
{
   // #[Route('/', name: 'app_user_index', methods: ['GET'])]
    //public function index(UserRepository $userRepository): Response
    //{
     //   return $this->render('user/index.html.twig', [
      //      'users' => $userRepository->findAll(),
      //  ]);
   // }


    #[Route('/{id}', name: 'app_user_show', methods: ['GET']),IsGranted('ROLE_ADMIN')]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }


    #[Route('/{id}', name: 'app_user_delete', methods: ['POST']),IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER);
    }



    #[Route('/recherche', name: 'recherche' )]
    public function search_User(Request $request , EntityManagerInterface $em )
    {

        //initialement le tableau des articles est vide,
        //c.a.d on affiche les articles que lorsque l'utilisateur clique sur le bouton rechercher
        $users=null;
        if($request->isMethod('POST')) {
            $nom = $request->request->get("nom");
            $query = $em->createQuery(
                "SELECT user FROM App\Entity\User user where user.nom LIKE '".$nom."'"
            );
            $users=$query->getResult();
        }
        return  $this->render('user/searchuser.html.twig',['users' => $users]);
    }

}
