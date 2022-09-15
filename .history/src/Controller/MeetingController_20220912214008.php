<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeetingController extends AbstractController
{
    #[Route('/rendezvous', name: 'meeting')]
    public function index(): Response
    {
        return $this->render('meeting/index.html.twig');
    }

    #[Route('/calendar', name: 'calendar_func')]
    public function calendar_func(): Response
    {
        return $this->render('meeting/calendar.html.twig');
    }
}
