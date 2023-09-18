<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       for ($i=0;$i<10;$i++){
           //Créer un étudiant
           $etudiant=new Etudiant();
           $etudiant->setPrenom("prenom$i");
           // ...
            $manager->persist($etudiant); // == INSERT Into Etudiant Value(...)
       }

        $manager->flush(); // Balance la requête juste au dessus en optimisant. Ca envoie l'ordre
    }
}
