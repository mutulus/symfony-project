<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PromotionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");
        //Création de 10 promotions
        for ($i = 1; $i <= 10; $i++) {
            $promotion = new Promotion();
            $promotion->setLibelle($faker->unique()->word());
            $promotion->setAnnee("2023");
            //Créer une référence pour la promotion
            $this->setReference("promotion_$i", $promotion);
            $manager->persist($promotion);
        }

        $manager->flush();
    }
}
