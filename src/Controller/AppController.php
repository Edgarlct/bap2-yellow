<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\EquipeRepository;
use App\Repository\OfferRepository;
use App\Repository\SocialRepository;
use App\Repository\SocialTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(OfferRepository $offerRepository, EquipeRepository $equipeRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $newsletter = new Newsletter();
        $newsletterForm = $this->createForm(NewsletterType::class, $newsletter);

        $newsletterForm->handleRequest($request);
        if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()){
            $newsletter->setEmail($newsletterForm->get("email")->getData());
            $newsletter->setIsSub(true);
            $entityManager->persist($newsletter);
            $entityManager->flush();
        }
        return $this->render('app/index.html.twig', [
            'offers' => $offerRepository->findAll()[0],
            'teamMembers' => $equipeRepository->findAll(),
            'newsletterForm' => $newsletterForm->createView(),
        ]);
    }

    public function footer(
        SocialRepository $socialRepository,
        SocialTypeRepository $socialTypeRepository
    )
    {
        return $this->render('partial/footer.html.twig', [
            'socials' => $socialRepository->findBy(['type' => $socialTypeRepository->findBy(['name' => "url"])]),
            "tel" => $socialRepository->findOneBy(['type' => $socialTypeRepository->findBy(['name' => 'tel'])])
        ]);
    }
}
