<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use APP\Entity\Entreprise;
use APP\Entity\Formation;
use APP\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        
        $faker = \Faker\Factory::create('fr_FR');

        $stage= new TypeRessource();
        $stage = setNomType("stage");
        
        $entreprise= new TypeRessource();
        $entreprise = setNomType("entreprise");
        
        $DUTInfo = new Formation();
        $DUTInfo->setNomCourt("DUT INFO");
        $DUTInfo->setNomLong("DUT Informatique");
       
        $DUTGea = new Formation();
        $DUTGea->setNomCourt("DU TIC");
        $DUTGea->setNomLong("DU Technologies de l'Information et de la Communication");

        $manager->flush();
    }
}
