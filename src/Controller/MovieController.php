<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movies", name="app_show_all_movies")
     */
    public function showAllMovies(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAllMovies();

        return $this->render('movie/all_movies.html.twig', [
            'movies' => $movies,
        ]);
    }
}
