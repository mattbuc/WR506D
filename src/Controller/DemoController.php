<?php

namespace App\Controller;

use App\Service\SentenceSlug;
use Locale;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route('/demo', name: 'app_demo')]
    public function index(SentenceSlug $sentenceSlug): Response
    {
        $date = new \DateTime();
        $phrase = $sentenceSlug->slugify('Test Test');

        return $this->render('demo/index.html.twig', [
            'date' => $date,
            'slug' => $phrase,
            
        ]);
    }
}
