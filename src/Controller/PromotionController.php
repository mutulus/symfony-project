<?php

namespace App\Controller;

use App\DataFixtures\PromotionFixtures;
use App\Entity\Promotion;
use App\Repository\EtudiantRepository;
use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    #[Route('/promotion', name: 'app_promotion')]
    public function list(PromotionRepository $promotionRepository): Response
    {
        $promotions=$promotionRepository->findAll();
        return $this->render('promotion/index.html.twig',[
            "promotions"=>$promotions
        ]);
    }

    #[Route('/promotion/{libelle}', name: 'app_promotion_etu')]
    public function listEtudiantPromo(PromotionRepository $promotionRepository,EtudiantRepository $etudiantRepository,Promotion $libelle): Response
    {
        $promotion=$promotionRepository->findOneBy(array("libelle"=>$libelle));
        $etudiants=$etudiantRepository->findBy(array("promotion"=>$promotion->getId()),array("ASC"));
        return $this->render('promotion/show.html.twig',[
            "promotion"=>$promotion
            ,"etudiants"=>$etudiants
        ]);
    }
}
