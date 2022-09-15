<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\MassageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeetingController extends AbstractController
{
    #[Route('/rendezvous', name: 'meeting')]
    public function index(MassageRepository $massageRepository): Response
    {
        $messages = $massageRepository->findAll();

        return $this->render('meeting/index.html.twig', [
            'messages' => $messages
        ]);
    }

    #[Route('/calendar', name: 'calendar')]
    public function calendar(BookingRepository $bookingRepository): Response
    {
        $bookings = $bookingRepository->findAll();

        $calendars = [];

        foreach($bookings as $booking) {
            $calendars [] = [
                'id' => $booking->getId(),
                'start' => $booking->getDebut()->format('Y-m-d H:i:s'),
                'end' => $booking->getFin()->format('Y-m-d H:i:s'),
                'title' => $booking->getTitre(),
            ];
        }


        return $this->render('meeting/calendar.html.twig', ['calendars' => json_encode($calendars)]);
    }
}
