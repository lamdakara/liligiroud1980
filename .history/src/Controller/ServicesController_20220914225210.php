<?php

namespace App\Controller;

use App\Repository\MassageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    #[Route('/prestationsettarifs', name: 'services')]
    public function index(MassageRepository $massageRepository): Response
    {
        $messages = $massageRepository->findAll();

        return $this->render('services/index.html.twig', [
            'messages' => $messages
        ]);
    }
}
