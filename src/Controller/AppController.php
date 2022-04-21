<?php

namespace App\Controller;

use App\Repository\EquipeRepository;
use App\Repository\OfferRepository;
use App\Repository\SocialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(OfferRepository $offerRepository, EquipeRepository $equipeRepository,): Response
    {
        return $this->render('app/index.html.twig', [
            'offers' => $offerRepository->findAll(),
            'teamMembers' => $equipeRepository->findAll(),
        ]);
    }

    public function footer(
        SocialRepository $socialRepository
    )
    {
        return $this->render('partial/footer.html.twig', [
            'socials' => $socialRepository->findAll(),
        ]);
    }
}
