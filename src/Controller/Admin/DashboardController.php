<?php

namespace App\Controller\Admin;

use App\Entity\BlogContent;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Newsletter;
use App\Entity\Offer;
use App\Entity\RequestContact;
use App\Entity\SubjectContact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend

         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Yallow');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('User', 'fa fa-user-o');
        yield MenuItem::section('Blog');
        yield MenuItem::linkToCrud('Categories du blog', 'fa fa-tags', Category::class);
        yield MenuItem::linkToCrud('Article de blog', 'fa fa-file-text-o', BlogContent::class);
        yield MenuItem::linkToCrud('Commentaire d\'article', 'fa fa-comments-o', Comment::class);
        yield MenuItem::section('Contact');
        yield MenuItem::linkToCrud('Sujet d\'une demande', 'fa fa-question-circle-o', SubjectContact::class);
        yield MenuItem::linkToCrud('Demande de contact', 'fa fa-address-book-o', RequestContact::class);
        yield MenuItem::linkToCrud('Base e-mail', 'fa fa-envelope-o', Newsletter::class);
        yield MenuItem::section('Offre');
        yield MenuItem::linkToCrud('Offre d\'abonnement', 'fa fa-shopping-bag', Offer::class);

    }
}
