<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionListController extends AbstractController
{
    /**
     * @Route("/subscription/list", name="subscription_list")
     */
    public function index(): Response
    {
        $inp = file_get_contents('results.json');


        return $this->render('subscription_list/index.html.twig', [
            'controller_name' => 'SubscriptionListController',
            'data' => $inp
        ]);
    }
}
