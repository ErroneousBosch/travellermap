<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class MetadataController extends AbstractController
{

    public function __construct(
        private \App\Service\TravellerMapApi $travellerMapApi
    )
    {

    }

    #[Route('/metadata', name: 'app_metadata')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MetadataController.php',
        ]);
    }

    #[Route('/metadata/allegiances', name: 'app_metadata_allegiances')]
    public function getAllegiances(): JsonResponse
    {
        return $this->json($this->travellerMapApi->getAllegiances());
    }

}
