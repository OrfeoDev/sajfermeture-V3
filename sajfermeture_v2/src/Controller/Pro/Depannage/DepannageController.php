<?php

namespace App\Controller\Pro\Depannage;

use App\Entity\Authentication\User;
use App\Entity\Demande\Image;
use App\Entity\Depannage\DemandePro;
use App\Entity\Depannage\TypeDepannage;
use App\Entity\General\DemandeStatut;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Pro\Depannage\DemandeProFormType;
use App\Repository\Depannage\DemandeProRepository;
use App\Repository\Depannage\TypeDepannageRepository;
use App\Repository\General\DemandeStatutRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpKernel\KernelInterface;

class DepannageController extends AbstractController
{
    #[Route('/pro/depannage', name: 'app_pro_depannage')]
    #[IsGranted('ROLE_USER')]
    public function index(TypeDepannageRepository $typeDepannageRepository, DemandeStatutRepository $demandeStatutRepository, DemandeProRepository $demandeProRepository, KernelInterface $kernelInterface, Request $request, EntityManagerInterface $manager): Response
    {
        $demandePro = new DemandePro;
        /**
         * @var DemandeStatut
         */
        $todoStatut = $demandeStatutRepository->findOneByValue("todo");

        $form = $this->createForm(DemandeProFormType::class, $demandePro);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /**
             * @var User
             */
            $user = $this->getUser();

            /**
             * @var TypeDepannage
             */
            $typeDepanage = $typeDepannageRepository->findOneByValue($form->get('typeDepannage')->getData());

            $demandePro->setProfessionnel($user->getProfessionnel());
            $todoStatut->addDemandePro($demandePro);
            $typeDepanage->addDemandePro($demandePro);
            
            foreach ($form->get('images')->getData() as $imageParsed) {
               /**
                * @var UploadedFile
                */
               $imageUploaded = $imageParsed;
              
               $newFileName = "image_" . uniqid() . "." . $imageUploaded->guessExtension();
   
               try {
                   $imageUploaded->move(
                       $kernelInterface->getProjectDir() . '/public/images/depannage',
                       $newFileName
                   );
               } catch (FileException $e) {
                   dd($e->getMessage());
                   // ... handle exception if something happens during file upload
               }

               $image = new Image;
               $image->setFileName('/images/depannage/' . $newFileName);

               $demandePro->addImage($image);
            }

            $manager->persist($demandePro);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre demande de dépannage a bien été envoyée, nous vous contacterons ultèrieurement'
            );

            return $this->redirectToRoute('app_dahsboard_pro');
        }

        return $this->render('pro/depannage/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
