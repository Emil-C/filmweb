<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Movie;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/movie/{title}?{id}", name="app_show_one_movie")
     */
    public function showOneMovieWithComments(
        CommentRepository $commentRepository,
        Request $request,
        Movie $movie,
        PaginatorInterface $paginator
    ): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        $queryBuilder = $commentRepository->findMovieCommentsByOldest($movie);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setText($form->get('text')->getData());
            $comment->setCreatedAt();
            $comment->setMovie($movie);
            $comment->setAuthor($this->getUser());

            $commentRepository->save($comment);

            return $this->redirectToRoute('app_show_one_movie', [
                'title' => $movie->getTitle(),
                'id' => $movie->getId(),
                'page' => $request->query->getInt('page')
            ]);
        }
        return $this->render('movie/movie_profile.html.twig', [
            'movie' => $movie,
            'commentForm' => $form->createView(),
            'pagination' => $pagination
        ]);
    }


}