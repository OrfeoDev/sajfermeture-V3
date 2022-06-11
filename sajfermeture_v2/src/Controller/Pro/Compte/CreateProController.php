<?php

namespace App\Controller\Pro\Compte;

use App\Entity\Authentication\User;
use App\Entity\Client\Pro\Professionnel;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Pro\Compte\CreateProFormType;
use App\Form\Pro\Compte\CheckTokenFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Setting\AppInformationRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateProController extends AbstractController
{
    #[Route('/pro/compte/check-token', name: 'app_pro_check_token_token')]
    public function checkToken(SessionInterface $sessionInterface, AppInformationRepository $appInformationRepository, Request $request): Response
    {
        // On récupère les informations de l'entitié AppInformation
        $appInformation = $appInformationRepository->findAll()[0];

        $form = $this->createForm(CheckTokenFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $tokenFromForm = $form->get('token')->getData();

            // Vérification si le token envoyé via le form est identique à celui enregistré en base
            if($tokenFromForm == $appInformation->getTokenCreateComptePro()){
                $sessionInterface->set("tokenComprePro", true);

                return $this->redirectToRoute("app_pro_create_compte_pro");
            } else {
                $this->addFlash(
                    "warning",
                    "Le code d'accès renseigné n'est pas valide"
                );
    
                return $this->redirectToRoute("app_pro_check_token_token");
            }
        }

        return $this->render('pro/compte/create_pro/check-token-form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/pro/compte/create-form', name: 'app_pro_create_compte_pro')]
    public function createComptePro(UserPasswordHasherInterface $hasher, SessionInterface $sessionInterface, Request $request, EntityManagerInterface $manager): Response
    {
        if($sessionInterface->get("tokenComprePro")){
            $comptePro = new Professionnel;
    
            $form = $this->createForm(CreateProFormType::class, $comptePro);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $user = new User;
                $user->setEmail($comptePro->getEmail())
                     ->setPassword($hasher->hashPassword($user, "password"));

                $comptePro->setUser($user);
                $user->setProfessionnel($comptePro);

                $manager->persist($user);
                $manager->persist($comptePro);
                $manager->flush();

                $sessionInterface->remove("tokenComprePro");

                $this->addFlash(
                    "success",
                    "Votre compte a été créé avec succès"
                );

                return $this->redirectToRoute("app_login");
            }
    
            return $this->render('pro/compte/create_pro/create-pro-form.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            $this->addFlash(
                "warning",
                "Vous n'êtes pas autorisé à accéder à cette ressource, veuillez renseigner un code d'accès valide"
            );

            return $this->redirectToRoute("app_pro_check_token_token");
        }
    }
}
