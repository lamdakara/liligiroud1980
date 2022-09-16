<?php

namespace App\Controller;

use App\Service\MailjetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]

    // GERER LA VUE
    public function index(MailjetService $mailjetService): Response
    {
        $mailjetService->sendEmail('sekouba.fofana@bbox.fr', 'kara', 'Rappel de rdv', 'Hello ceci est un rappel');

        return $this->render('home/index.html.twig');
    }
}
