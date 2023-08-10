<?php

namespace App\Controller;

use App\Repository\WwishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wishes', name: 'wish')]
class WishController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function list(
        WwishRepository $WwishRepository
    ): Response
    {
        $wishes = $WwishRepository ->findBy(
            ["isPublished" => true],
            ["dateCreated" => "ASC"]
        );
        return $this->render('wish/list.html.twig',
            compact('wishes')
        );
    }

    #[Route('/detail/{di}', name: '_details', requirements: ["di" =>"\d+"])]
    public function detail(
        WwishRepository $WwishRepository,
        int $di=42,
    ): Response
    {

        $wish = $WwishRepository->findOneBy(
            ["di" => $di]
        );
        return $this->render('wish/detail.html.twig',
        compact('wish')
           );


}}