<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sector;

class MapController extends AbstractController
{
    #[Route('/', name: 'app_map')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'MapController',
            'sectorList' => ['M1105:-4:-1'],
        ]);
    }
}
