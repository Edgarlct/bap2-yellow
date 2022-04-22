<?php

namespace App\Controller;

use App\Repository\BlogContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(BlogContentRepository $blogContentRepository): Response
    {
        $blog = $blogContentRepository->findBy([], ["createdAt" => "ASC"], 9);
        return $this->render('blog/index.html.twig', [
            'blogArticle' => $blog,
        ]);
    }
}
