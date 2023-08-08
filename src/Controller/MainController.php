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
        return $this->render('main/home.html.twig');
    }

    #[Route('/details', name: 'main_details')]
    public function detailler(): Response
    {
        $tache = [
            "1" => "manger",
            "2" => "repasser"];
        return $this->render('main/detailler.html.twig', [
            "tache" => $tache,
        ]);
    }

    #[Route('/aboutUs', name: 'main_about')]
    public function aboutUs(): Response
    {
        // Lire le fichier json
        $fichier = file_get_contents('json/team.json');

        // Décoder le fichier json
        $equipe = json_decode($fichier, true);

        // Envoyer le json au twig
        return $this->render('main/about.html.twig',
        compact('equipe')
        );
    }


//#[Route('/about-us', name: 'main_about_us')]
//public function about_us(): Response
//{
//    return $this->render(
//        'main/about_us.html.twig',
//        [
//            "equipe" => json_decode(file_get_contents('../data/team.json'), true)
//        ]
//    );
//}


}
