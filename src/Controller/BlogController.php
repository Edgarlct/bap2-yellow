<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\BlogContentType;
use App\Form\CommentType;
use App\Repository\BlogContentRepository;
use App\Repository\CommentRepository;
use App\Repository\SocialRepository;
use App\Repository\SocialTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(BlogContentRepository $blogContentRepository, Request $request): Response
    {
//        Potential pagination

//        if (!empty($request->query->get("page"))){
//            $offset = ($request->query->get("page")-1) * 9;
//            $blog = $blogContentRepository->findBy(["isVisible" => true], ["createdAt" => "ASC"], 9, $offset);
//        }
//        else{
//            $blog = $blogContentRepository->findBy(["isVisible" => true], ["createdAt" => "ASC"], 9);
//        }
//        $blogCount = $blogContentRepository->findBy(["isVisible" => true]);
//        return $this->render('blog/index.html.twig', [
//            "request" => $request,
//            "pageNumber" => (int) ceil(count($blogCount)/9),
//            'blogArticle' => $blog,
//        ]);

        $blog = $blogContentRepository->findBy(["isVisible" => true], ['id' => "DESC"]);
        return $this->render('blog/index.html.twig', [
            'blogArticle' => $blog,
        ]);
    }

    #[Route('/blog/show/{id}', name: 'app_blog_show')]
    public function show(Request $request, BlogContentRepository $blogContentRepository, CommentRepository $commentRepository, EntityManagerInterface $entityManager, SocialTypeRepository $socialTypeRepository, SocialRepository $socialRepository){
        $article = $blogContentRepository->find($request->get('id'));

        $commentEntity = new Comment();
        $commentForm = $this->createForm(CommentType::class, $commentEntity);

        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()){
            $commentEntity->setUser($this->getUser());
            $commentEntity->setContent($commentForm->get('content')->getData());
            $commentEntity->setBlog($article);
            $entityManager->persist($commentEntity);
            $entityManager->flush();
        }

        $comment = $commentRepository->findBy(["blog" => $article], ['id' => "DESC"]);
        $similarContent = $blogContentRepository->findBy(["category" => $article->getCategory()], ['id' => 'DESC'], 4);
        return $this->render('blog/show.html.twig', [
            'form' => $commentForm->createView(),
            'article' => $article,
            'comments' => $comment,
            'similar' => $similarContent,
            'socials' => $socialRepository->findBy(['type' => $socialTypeRepository->findBy(['name' => "url"])]),
        ]);
    }
}
