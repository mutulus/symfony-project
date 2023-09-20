<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiants', name: 'app_etudiant_list')]
    public function list(EtudiantRepository $etudiantRepository): Response
    {
        //Appel au modèle
        //Le controlleur va demander au modèle la liste des étudiants
        $etudiants = $etudiantRepository->findAll();

        return $this->render('etudiant/index.html.twig', ["etudiants" => $etudiants
            ]
        );
    }

    #[Route('/etudiants/{id}', name: 'app_etudiant_list_show',requirements: ['id'=> '\d+'])]
    public function show(EtudiantRepository $etudiantRepository, int $id): Response
    {
        $etudiant = $etudiantRepository->find($id);
        $age = $etudiant->getAge();
        $promotion=$etudiant->getPromotion()->getLibelle();
        return $this->render('etudiant/show.html.twig', ["etudiant" => $etudiant, "age" => $age,"promotion"=>$promotion]
        );
    }
    #[Route('//etudiants/mineurs', name: 'app_etudiant_mineurs_list')]
    public function listMineurs(EtudiantRepository $etudiantRepository): Response
    {

        //Appel au modèle
        $etudiants=$etudiantRepository->findMineurs2();



        return $this->render('etudiant/index.html.twig',["etudiants"=>$etudiants]);
    }


}
