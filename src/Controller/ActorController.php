<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/actor/{id}", name="app_show_actor_profile")
     */
    public function showActorProfile(Actor $actor): Response
    {
        return $this->render('actor/actor_profile.html.twig', [
            'actor' => $actor,
        ]);
    }
}
