<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/details', name: 'main_details')]
    public function detailler(): Response
    {
        $tache = [
            "1" => "manger",
            "2" => "repasser"];
        return $this->render('detailler.html.twig', [
            "tache" => $tache,
        ]);
    }
}
