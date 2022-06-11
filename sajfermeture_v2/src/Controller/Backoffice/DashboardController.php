<?php

namespace App\Controller\Backoffice;

use App\Entity\Depannage\DemandePro;
use App\Entity\Depannage\TypeDepannage;
use App\Entity\Devis\DemandeDevis;
use App\Entity\General\DemandeStatut;
use App\Repository\Depannage\DemandeProRepository;
use App\Repository\Depannage\TypeDepannageRepository;
use App\Repository\Devis\DemandeDevisRepository;
use App\Repository\General\DemandeStatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    #[Route('/backoffice/dashboard', name: 'app_backoffice_dashboard')]
    #[IsGranted('ROLE_BACKOFFICE')]
    public function index(DemandeDevisRepository $demandeDevisRepository, DemandeProRepository $demandeProRepository, TypeDepannageRepository $typeDepannageRepository, DemandeStatutRepository $demandeStatutRepository): Response
    {
        // 1 : Récupération des status non traité et traité
        /**
         * @var DemandeStatut
         */
        $todoStatut = $demandeStatutRepository->findOneByValue("todo");

        /**
         * @var DemandeStatut
         */
        $doneStatut = $demandeStatutRepository->findOneByValue("done");

        // 2 : Récupération de toutes les demandes pro et de devis non traitées
        $demandesProTodo = $todoStatut->getDemandePros();
        $demandesDevisTodo = $todoStatut->getDemandeDevis();

        // 3 : Récupération de toutes les demandes pro et devis traitées
        $demandesProDone = $doneStatut->getDemandePros();
        $demandesDevisDone = $doneStatut->getDemandeDevis();

        // 4 : Récupération des indicateurs
        /**
         * @var TypeDepannage
         */
        $typeDepannagePorte = $typeDepannageRepository->findOneByValue("porte");

        /**
         * @var TypeDepannage
         */
        $typeDepannageMoteur = $typeDepannageRepository->findOneByValue("moteur");

        /**
         * @var TypeDepannage
         */
        $typeDepannageAll = $typeDepannageRepository->findOneByValue("all");

        $demandesPortes = $typeDepannagePorte->getDemandePros();
        $demandesMoteur = $typeDepannageMoteur->getDemandePros();
        $demandesAll    = $typeDepannageAll->getDemandePros();

        return $this->render('backoffice/dashboard/index.html.twig', [
            'deamndesPro'       => $demandeProRepository->findAll(),
            'demandeDevis'      => $demandeDevisRepository->findAll(),
            'demandesProTodo'   => $demandesProTodo,
            'demandesDevisTodo' => $demandesDevisTodo,
            'demandesProDone'   => $demandesProDone,
            'demandesDevisDone' => $demandesDevisDone,
            'demandesPortes'    => $demandesPortes,
            'demandesMoteur'    => $demandesMoteur,
            'demandesAll'       => $demandesAll,
        ]);
    }

    #[Route('/backoffice/dashboard/change-status-of-demande/{id}', name: 'app_backoffice_dashboard_change_status_of_demande')]
    #[IsGranted('ROLE_BACKOFFICE')]
    public function changeStatusOfDemande(EntityManagerInterface $manager, DemandeStatutRepository $demandeStatutRepository, DemandePro $demandePro) : Response
    {
        /**
         * @var DemandeStatut
         */
        $todoStatut = $demandeStatutRepository->findOneByValue("todo");
        $todoStatut->removeDemandePro($demandePro);
        /**
         * @var DemandeStatut
         */
        $doneStatut = $demandeStatutRepository->findOneByValue("done");
        $doneStatut->addDemandePro($demandePro);

        $manager->persist($todoStatut);
        $manager->persist($doneStatut);
        $manager->persist($demandePro);

        $manager->flush();

        $this->addFlash(
            'success',
            'La demande a été traitée avec succès'
        );

        return $this->redirectToRoute('app_backoffice_dashboard');
    }

    #[Route('/backoffice/dashboard/change-status-of-demande-devis/{id}', name: 'app_backoffice_dashboard_change_status_of_demande_devis')]
    #[IsGranted('ROLE_BACKOFFICE')]
    public function changeStatusOfDemandeDevis(EntityManagerInterface $manager, DemandeStatutRepository $demandeStatutRepository, DemandeDevis $demandeDevis) : Response
    {
        /**
         * @var DemandeStatut
         */
        $todoStatut = $demandeStatutRepository->findOneByValue("todo");
        $todoStatut->removeDemandeDevi($demandeDevis);
        /**
         * @var DemandeStatut
         */
        $doneStatut = $demandeStatutRepository->findOneByValue("done");
        $doneStatut->addDemandeDevi($demandeDevis);

        $manager->persist($todoStatut);
        $manager->persist($doneStatut);
        $manager->persist($demandeDevis);

        $manager->flush();

        $this->addFlash(
            'success',
            'La demande  de devis a été traitée avec succès'
        );

        return $this->redirectToRoute('app_backoffice_dashboard');
    }
}
