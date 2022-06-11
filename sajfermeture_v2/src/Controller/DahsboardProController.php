<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DahsboardProController extends AbstractController
{
    #[Route('/dahsboard/pro', name: 'app_dahsboard_pro')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('dahsboard_pro/index.html.twig', [
            'controller_name' => 'DahsboardProController',
        ]);
    }
}
