<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Service\StripePayment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(BookingRepository $bookingRepository, StripePayment $stripePayment): Response
    {
        $publicKey = $this->getParameter('app.public_key');

        // on récupere les reservations pas encore payer par l'utilisateur connecté
        $bookings = $bookingRepository->findBy(['payer' => false, 'user' => $this->getUser()]);

        // calculer le prix totale que l'utilisateur devrait payer
        $total = 0;
        foreach($bookings as $booking) {
            $total += $booking->getService()->getPrix();
        }

        $intent = $stripePayment->paymentIntent($total);

        $url = $this->generateUrl('app_payment_success');

        return $this->render('panier/index.html.twig', [
            'bookings' => $bookings,
            'public_key' => $publicKey, 
            'total'    => $total,
            'intent' => $intent,
            'url_redirect' => $url
        ]);
    }

    #[Route('/payment/success', name: 'app_payment_success')]
    public function success(BookingRepository $bookingRepository, EntityManagerInterface $entityMnager): Response
    {
        // on récupere les reservations pas encore payer par l'utilisateur connecté
        $bookings = $bookingRepository->findBy(['payer' => false, 'user' => $this->getUser()]);

        // mettre le status payer à true
        
        foreach($bookings as $booking) {
            $booking->setPayer(true);
            $entityMnager->flush();
        }

        $this->addFlash('success', 'Votre payment à bien été receptionné !');

        return $this->redirectToRoute('home');
    }
}
