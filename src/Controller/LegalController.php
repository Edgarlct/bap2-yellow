<?php

namespace App\Controller;

use App\Repository\LegalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    #[Route('/legal', name: 'app_legal')]
    public function index(LegalRepository $legalRepository): Response
    {
        return $this->render('legal/index.html.twig', [
            'legal' => $legalRepository->findAll()[0],
        ]);
    }
}
