<?php

namespace App\Controller;

use App\Controller\Admin\BlogContentCrudController;
use App\Entity\BlogContent;
use App\Form\BlogContentType;
use App\Repository\BlogContentRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogContentController extends AbstractController
{

    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/blog/content', name: 'app_blog_content')]
    public function index(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository): Response
    {

        //          generate url for blog content in admin
        $url = $this->adminUrlGenerator
            ->setController(BlogContentCrudController::class)
            ->generateUrl();

        $content = new BlogContent();
        $form = $this->createForm(BlogContentType::class, $content);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $content->setName($form->get("name")->getData());
            $content->setCategory($categoryRepository->find($form->get("category")->getData()));
            $content->setContent($form->get("content")->getData());
            $content->setOpenComment($form->get("openComment")->getData());
            $content->setIsVisible($form->get("isVisible")->getData());
            $entityManager->persist($content);
            $entityManager->flush();
            return $this->redirect($url);
        }
        return $this->render('blog_content/index.html.twig', [
            'url' => $url,
            "form" => $form->createView(),
        ]);
    }


//    edit blog content
    #[Route('/blog/content/edit', name: 'app_blog_content_edit')]
    public function edit(Request $request, CategoryRepository $categoryRepository, BlogContentRepository $blogContentRepository, EntityManagerInterface $entityManager): Response
    {

        //          generate url for blog content in admin
        $url = $this->adminUrlGenerator
            ->setController(BlogContentCrudController::class)
            ->generateUrl();

        $content = new BlogContent();
        $form = $this->createForm(BlogContentType::class, $content);
//        set data in field
        $form->get("content")->setData($request->get("content"));
        $form->get("name")->setData($request->get("name"));
        $form->get("category")->setData($categoryRepository->find($request->get("category")));
        $form->get("isVisible")->setData(($request->get("visible") === "1"));
        $form->get("openComment")->setData(($request->get("comment") === "1"));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
//            save data in base
            $contentEdit = $blogContentRepository->find($request->get("id"));
            $contentEdit->setName($form->get("name")->getData());
            $contentEdit->setCategory($categoryRepository->find($form->get("category")->getData()));
            $contentEdit->setContent($form->get("content")->getData());
            $contentEdit->setOpenComment($form->get("openComment")->getData());
            $contentEdit->setIsVisible($form->get("isVisible")->getData());
            $entityManager->persist($contentEdit);
            $entityManager->flush();

            return $this->redirect($url);
        }

        return $this->render('blog_content/index.html.twig', [
            "url" => $url,
            "form" => $form->createView(),
        ]);
    }
}
