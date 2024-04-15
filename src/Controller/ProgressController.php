<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProgressController extends AbstractController
{
    #[Route('/cooking', name: 'app_cooking')]
    public function cooking(): Response
    {
        return $this->render('cooking.html.twig');
    }
    #[Route('/stats', name: 'app_stats')]
    public function stats(): Response
    {
        return $this->render('cooking.html.twig',);
    }
}
