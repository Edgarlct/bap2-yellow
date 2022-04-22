<?php

namespace App\Controller;

use App\Entity\RequestContact;
use App\Form\ContactType;
use App\Repository\SubjectContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestContactController extends AbstractController
{
    #[Route('/contact', name: 'app_request_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, SubjectContactRepository $subjectContactRepository): Response
    {
        $requestContact = new RequestContact();
        $ContactForm = $this->createForm(ContactType::class, $requestContact);

        $ContactForm->handleRequest($request);
        if ($ContactForm->isSubmitted() && $ContactForm->isValid()){
            $requestContact->setEmail($ContactForm->get("email")->getData());
            $requestContact->setFirstName($ContactForm->get("firstName")->getData());
            $requestContact->setLastName($ContactForm->get("lastName")->getData());
            $requestContact->setSubject($subjectContactRepository->find($ContactForm->get("subject")->getData()));
            $requestContact->setContent($ContactForm->get("content")->getData());
            $entityManager->persist($requestContact);
            $entityManager->flush();
        }
        return $this->render('request_contact/index.html.twig', [
            'form' => $ContactForm->createView(),
        ]);
    }
}
