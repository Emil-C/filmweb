<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="app_show_account")
     */
    public function showAccount(): Response
    {
        $user = $this->getUser();
        
        return $this->render('account/account.html.twig', [
            ]);
        }

    /**
     * @Route("/account/edit/", name="app_update_account")
     */
    public function updateAccount(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(AccountFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $locale = $form['locale']->getData();
            $user->setLocale($locale);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_show_account');
        }

        return $this->render('account/update_account.html.twig', [
            'accountForm' => $form->createView()
        ]);
    }
}
