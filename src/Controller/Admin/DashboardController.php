<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )

    {   
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(ArticleCrudController::class)/* recuperer l'URL admin pour le back office de l'entité Article avec son crud */
        ->generateUrl();
        
        return $this->redirect($url);


        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

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
            ->setTitle('symfony CMS');
    }

    public function configureMenuItems(): iterable //YIELD Les générateurs fournissent une façon simple de mettre en place des itérateurs sans le coût ni la complexité du développement d’une classe qui implémente l’interface Iterator. Un générateur vous permet d’écrire du code qui utilise foreach pour parcourir un jeu de données, sans avoir à construire un tableau en mémoire pouvant conduire à dépasser la limite de la mémoire ou nécessiter un temps important pour sa génération. Au lieu de cela, vous pouvez écrire une fonction générateur, qui est identique à une fonction normale, mis à part le fait qu’au lieu de retourner une seule fois, un générateur peut utiliser yield autant de fois que nécessaire, afin de fournir les valeurs à parcourir.
    {//creation menu du tableau de bord back-office//
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')-> setSubItems([
            MenuItem::linkToCrud('Tous les articles','fas fa-newspaper',Article::class),
            MenuItem::linkToCrud('Ajouter','fas fa-plus',Article::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Categories','fas fa-list',Category::class)
        ]); // en lien avec l'entité Article //
    }
}
