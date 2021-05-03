<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SubscriptionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class SubscriptionController extends AbstractController
{
    /**
     * @Route("/subscription", name="subscription")
     */
    public function index(Request $request): Response
    {

        $encoders = [ new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

            $form = $this->createForm(SubscriptionType::class);


            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $tempArray = [];
                $contactFormData = $form->getData();

                $data[] = $_POST['subscription'];
                $data = $serializer->serialize($data, 'json');

                $inp = file_get_contents('results.json');

                $tempArray = json_decode($inp);
                array_push($tempArray, $data);

                $jsonData = $serializer->serialize($tempArray, 'json');
                file_put_contents('results.json', $jsonData);
                // save to file
            }

            return $this->render('subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
            'form' => $form->createView()
        ]);
    }
}
