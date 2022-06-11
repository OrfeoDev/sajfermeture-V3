<?php

namespace App\Controller\Pro\Devis;

use App\Entity\Devis\DemandeDevis;
use App\Entity\General\DemandeStatut;
use App\Form\Devis\DemandeDevisFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\General\DemandeStatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeDevisController extends AbstractController
{
    #[Route('/pro/devis/demande-devis', name: 'app_pro_devis_demande_devis')]
    #[IsGranted('ROLE_USER')]
    public function demandeDevis(DemandeStatutRepository $demandeStatutRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $demandeDevis = new DemandeDevis;

        /**
         * @var DemandeStatut
         */
        $todoStatut = $demandeStatutRepository->findOneByValue("todo");

        $form = $this->createForm(DemandeDevisFormType::class, $demandeDevis);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /**
             * @var User
             */
            $user = $this->getUser();

            $demandeDevis->setProfessionnel($user->getProfessionnel());
            $todoStatut->addDemandeDevi($demandeDevis);

            $manager->persist($demandeDevis);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre demande de devis a bien été envoyée, nous vous contacterons ultèrieurement'
            );

            return $this->redirectToRoute('app_dahsboard_pro');
        }

        return $this->render('pro/devis/demande_devis/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
