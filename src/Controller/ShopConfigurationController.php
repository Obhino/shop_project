<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopConfigurationController extends AbstractController
{
    #[Route('/shop/configuration', name: 'app_shop_configuration')]
    public function index(): Response
    {
        return $this->render('shop_configuration/index.html.twig', [
            'controller_name' => 'ShopConfigurationController',
        ]);
    }
}
