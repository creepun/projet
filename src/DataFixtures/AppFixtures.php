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
 
        $DUTInfo = new Formation();
        $DUTInfo->setNomCourt("DUT INFO");
        $DUTInfo->setNomLong("DUT Informatique");
       
        $DUTIC = new Formation();
        $DUTIC->setNomCourt("DU TIC");
        $DUTIC->setNomLong("DU Technologies de l'Information et de la Communication");
        
        $tableauDesFormations = array($DUTInfo, $DUTIC);

        foreach($tableauDesFormations as $tabFormations)
        {
            $manager->persist($tabFormations);
        }

        $nbRessourcesAGenerer = $faker->numberBetween($min = 4, $max = 25);
        for ($numRessource=0; $numRessource < $nbRessourcesAGenerer; $numRessource++) {
            $entreprise = new Entreprise();
            $entreprise = setNom($faker->company);
            $entreprise = setActivité($faker->realText($maxNbChars = 200, $indexSize = 2));
            $entreprise = setAdresse($faker->address);
            $entreprise = setURLSite($faker->domainName);
        }
        $manager->persist($entreprise);
        $manager->flush();
    }
}
