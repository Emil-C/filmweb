<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comments", name="app_show_all_comments")
     */
    public function showAllComments(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findAllComments();

        return $this->render('comment/all_comments.html.twig', [
            'comments' => $comments,
        ]);
    }
}