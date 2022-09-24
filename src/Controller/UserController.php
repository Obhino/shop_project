<?php

namespace App\Controller;

use App\Form\BoutiqueFormType;
use App\Repository\BoutiqueRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route(path: '/{username}', name: 'app_user')]
    public function index(Request $request, $username): Response
    {

        $user = $this->getUser();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user_name'=>$user->getUserIdentifier(),
        ]);
    }
    #[Route(path:'/{username}/admin', name:'app_shop_admin')]
    public function shopadmin(Request $request, UserRepository $userRepository, BoutiqueRepository $boutiqueRepository): Response
    {
        $user = $this->getUser();
        $userClass = $userRepository->findOneBy(['username'=>$user->getUserIdentifier()]);
        $listboutiques = $boutiqueRepository->findBy(['proprietaire'=>$userClass]);

        dump($userClass);
        dump($listboutiques);
        return $this->render('user/admin.html.twig',[
            'username'=>$user->getUserIdentifier(),
            'boutiques'=>$listboutiques,
        ]);

    }
    #[Route(path:'/{username}/admin/{shop}', name:'app_admin_ashop')]
    public function adminAshop(Request $request, $username, $shop, EntityManagerInterface $entityManager, BoutiqueRepository $boutiqueRepository, UserRepository $userRepository): Response{
        $boutique = $boutiqueRepository->findOneBy(['nom'=>$shop]);
        $user = $boutique->getProprietaire();
        if(!$username==$user->getUsername())
        {
            $this->redirectToRoute('app_main');
        }
        $form = $this->createForm(BoutiqueFormType::class, $boutique);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            $entityManager->persist($boutique);
            $entityManager->flush();
        }
        return $this->renderForm('user/adminAshop.html.twig',[
            'admin_shop_form'=>$form,
            'boutique'=>$boutique,
            'user'=>$user,
        ]);
    }

}
