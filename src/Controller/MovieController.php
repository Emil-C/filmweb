<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Service\DurationConverter;
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

    /**
     * @Route("/movie/{title}?{id}", name="app_show_one_movie")
     */
    public function showOneMovie(Movie $movie, DurationConverter $durationConverter): Response
    {
        return $this->render('movie/movie_profile.html.twig', [
            'movie' => $movie,
            'duration' => $durationConverter->convertToHours($movie->getDuration())
        ]);

    }
}
