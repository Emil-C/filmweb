<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function showOneMovie(Movie $movie, Request $request, CommentRepository $commentRepository): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        $comments = $commentRepository->findMovieCommentsByNewest($movie);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setText($form->get('text')->getData());
            $comment->setCreatedAt();
            $comment->setMovie($movie);
            $comment->setAuthor($this->getUser());

            $commentRepository->save($comment);

            return $this->redirectToRoute('app_show_one_movie', [
                'title' => $movie->getTitle(),
                'id' => $movie->getId()
            ]);
        }

        return $this->render('movie/movie_profile.html.twig', [
            'movie' => $movie,
            'commentForm' => $form->createView(),
            'comments' => $comments
        ]);
    }
}
