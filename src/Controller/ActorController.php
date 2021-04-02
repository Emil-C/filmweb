<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActorController extends AbstractController
{
    /**
     * @Route("/actors", name="app_show_all_actors")
     */
    public function showAllActors(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAllActors();

        return $this->render('actor/all_actors.html.twig', [
            'actors' => $actors,
        ]);
    }
}
