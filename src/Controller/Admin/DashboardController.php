<?php

namespace App\Controller\Admin;

use App\Entity\Actor;
use App\Entity\Comment;
use App\Entity\Genre;
use App\Entity\Movie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(MovieCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Filmweb');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('All movies', 'fa fa-home', 'app_show_all_movies');
        yield MenuItem::linkToCrud('Actors', 'fas fa-users', Actor::class);
        yield MenuItem::linkToCrud('Movies', 'fas fa-film', Movie::class);
        yield MenuItem::linkToCrud('Genres', 'fas fa-list', Genre::class);
        yield MenuItem::linkToCrud('Comments', 'fas fa-list', Comment::class);
    }
}
