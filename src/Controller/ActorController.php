<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use App\Service\ActorConverter;
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

    /**
     * @Route("/actor/{id}", name="app_show_actor_profile")
     */
    public function showActorProfile(Actor $actor, ActorConverter $actorConverter): Response
    {
        return $this->render('actor/actor_profile.html.twig', [
            'actor' => $actor,
            'fullName' => $actorConverter->getFullName($actor->getFName(), $actor->getLName())
        ]);
    }
}
