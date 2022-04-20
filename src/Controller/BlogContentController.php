<?php

namespace App\Controller;

use App\Entity\BlogContent;
use App\Form\BlogContentType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogContentController extends AbstractController
{
    #[Route('/blog/content', name: 'app_blog_content')]
    public function index(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository): Response
    {
        $content = new BlogContent();
        $form = $this->createForm(BlogContentType::class, $content);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $content->setName($form->get("name")->getData());
            $content->setCategory($categoryRepository->find(1));
            $content->setContent($form->get("content")->getData());
            $entityManager->persist($content);
            $entityManager->flush();

        }
        return $this->render('blog_content/index.html.twig', [
            "form" => $form->createView(),
            'controller_name' => 'BlogContentController',
        ]);
    }
}
