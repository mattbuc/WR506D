<?php

namespace App\Controller;

use Locale;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route('/demo', name: 'app_demo')]
    public function index(): Response
    {
        $date = new \DateTime();

        return $this->render('demo/index.html.twig', [
            'date' => $date,
        ]);
    }
}
