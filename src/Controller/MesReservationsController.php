<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesReservationsController extends AbstractController
{
    #[Route('/mes/reservations', name: 'app_mes_reservations')]
    public function index(BookingRepository $bookingRepository): Response
    {
        // on récupere tout les reservations de l'utilisateur qui est connecté
        $reservations = $bookingRepository->findBy(['user' => $this->getUser()]);

        return $this->render('mes_reservations/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}
