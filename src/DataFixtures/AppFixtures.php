<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

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
        for ($numEntreprise=0; $numEntreprise < $nbEntrepriseAGenerer; $numEntreprise++) {
            $entreprise = new Entreprise();
            $entreprise -> setNom($faker->company);
            $entreprise -> setActivité($faker->realText($maxNbChars = 200, $indexSize = 2));
            $entreprise -> setAdresse($faker->address);
            $entreprise -> setURLSite($faker->domainName);
            
            $nbStageAGenerer = $faker->numberBetween($min = 0, $max = 10);
            for ($numStage=0; $numStage < $nbStageAGenerer; $numStage++){
                $stage = new Stage();
                $stage -> setTitre($faker->realText($maxNbChars = 40, $indexSize = 2));
                $stage -> setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));
                $stage -> setEmail($faker->email);
                $stage -> setEntreprise($entreprise);
                
                $numFormation = $faker->numberBetween($min = 1, $max = 3);
                switch ($numFormation){
                    case 1:
                        $stage->addFormation($DUTInfo);
                        $DUTInfo->addStage($stage);
                        break;
                    case 2:
                        $stage->addFormation($DUTIC);
                        $DUTIC->addStage($stage);
                        break;
                    case 3:
                        $stage->addFormation($DUTInfo);
                        $DUTInfo->addStage($stage);
                        $stage->addFormation($DUTIC);
                        $DUTIC->addStage($stage);
                        break;
                }
                $entreprise->addStage($stage);
                $manager->persist($stage);
            }
            
            $manager->persist($entreprise);
        }
        
       
        $manager->persist($DUTIC);
        $manager->persist($DUTInfo);
        $manager->flush();
    }
}
