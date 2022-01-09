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

        $nbEntrepriseAGenerer = $faker->numberBetween($min = 4, $max = 25);
        for ($numRessource=0; $numRessource < $nbEntrepriseAGenerer; $numRessource++) {
            $entreprise = new Entreprise();
            $entreprise = setNom($faker->company);
            $entreprise = setActivité($faker->realText($maxNbChars = 200, $indexSize = 2));
            $entreprise = setAdresse($faker->address);
            $entreprise = setURLSite($faker->domainName);
            
            $nbStageAGenerer = $faker->numberBetween($min = 0, $max = 10);
            for ($numRessource=0; $numRessource < $nbStageAGenerer; $numRessource++){
                $stage = new Stage();
                $stage = setTitre($faker->jobTitle);
                $stage = setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));
                $stage = setEmail($faker->email);
                $stage = addEntreprise($entreprise);
                
                $numFormation = $faker->numberBetween($min = 1, $max = 3);
                switch ($numFormation){
                    case 1:
                        $stage->addFormation($DUTInfo);
                        $$DUTInfo->addStage($stage);
                        break;
                    case 2:
                        echo "i égal 1";
                        break;
                    case 3:
                        echo "i égal 2";
                        break;
                }
            }
            $entreprise->addStage($stage);
            $manager->persist($stage);
        }
        
        $manager->persist($entreprise);
        
        $manager->flush();
    }
}
