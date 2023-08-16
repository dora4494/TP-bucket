<?php

namespace App\Controller;

use App\Entity\Wwish;
use App\Form\WwishType;
use App\Repository\WwishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/wishes', name: 'wish')]
class WishController extends AbstractController
{


    #[Route('/list', name: '_list')]
    public function list(
        WwishRepository $WwishRepository
    ): Response
    {
        $wishes = $WwishRepository ->findAllPublished();
        return $this->render('wish/list.html.twig', ['wishes' => $wishes]);
    }
    /* Première version de la fonction list
    #[Route('/list', name: '_list')]
    public function list(
        WwishRepository $WwishRepository
    ): Response
    {
        $wishes = $WwishRepository ->findBy(
            [
                "isPublished" => true,
                "dateCreated" => "ASC"
            ],
            null,
            null,
            null
        );
        return $this->render('wish/list.html.twig', ['wishes' => $wishes]);
    }
*/

    /*Seconde version de la méthode detail
     * #[Route('/detail/{wish}', name: '_details', requirements: ["wish" =>"\d+"])]
    public function detail(Wwish $wish): Response
    {

        return $this->render('wish/detail.html.twig',
        compact('wish')
           );
}

*/



// Version si le package n'est pas reconnu
    #[Route('/detail/{id}', name: '_details', requirements: ["id" =>"\d+"])]
    public function detail(
        WwishRepository $WwishRepository,
        int $id,
    ): Response
    {

        $wish = $WwishRepository->findOneBy(
            ["id" => $id]
        );
        return $this->render('wish/detail.html.twig',
        compact('wish')
           );
}


    #[Route('/ajouter', name:'_ajouter')]
    #[isGranted('ROLE_USER')]
    public function ajouter(
        EntityManagerInterface $entityManager,
        Request $requete
    ) : Response
    {
        $wwish = new Wwish();
        $wwish->setIsPublished(true);
        $wwish->setDateCreated(new \DateTime());
        $wwish->setAuthor($this->getUser()->getUserIdentifier());

        $wwishForm = $this->createForm(WwishType::class, $wwish);

        $wwishForm->handleRequest($requete);

        if($wwishForm->isSubmitted()) {
            $entityManager->persist($wwish); // Cela fait la requête
            $entityManager->flush(); // fait la requête SQL
            return $this->redirectToRoute('wish_list');
        }

        // Etape 3: envoyer le formulaire au twig
        return $this->render('wish/ajout.html.twig',
            [
                "wwishForm"=>$wwishForm->createView()
            ]);


    }


}