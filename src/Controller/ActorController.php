<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\User;
use App\Form\LanguageFormType;
use App\Repository\ActorRepository;
use App\Service\ActorConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActorController extends AbstractController
{
    /**
     * @Route("/actors", name="app_show_all_actors")
     */
    public function showAllActors(ActorRepository $actorRepository, Request $request): Response
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

    /**
     * @Route("/change-language", name="app_change_language")
     */
    public function changeLanguage(Request $request) :Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(LanguageFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $locale = $form->getData()['language'];
            $user->setLocale($locale);

            $entityManager->persist($user);
            $entityManager->flush();            
            $this->addFlash('notice', 'Your changes were saved! Log out and log in again to make the changes visible.');
        }

        return $this->render('includes/_language_form.html.twig', [
            'languageForm' => $form->createView(),
        ]);
    }
}
