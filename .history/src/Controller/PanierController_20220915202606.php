<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(BookingRepository $bookingRepository): Response
    {
        // on récupere les reservations pas encore payer par l'utilisateur connecté
        $bookings = $bookingRepository->findBy(['payer' => false, 'user' => $this->getUser()]);

        return $this->render('panier/index.html.twig', [
            'bookings' => $bookings,
        ]);
    }
}
