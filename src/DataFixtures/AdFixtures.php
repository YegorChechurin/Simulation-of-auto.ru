<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Ad;
use App\DataFixtures\CarFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AdFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 14; $i++) { 
            $ref_number = $i+1;
            $cars[$i] = $this->getReference('Car'.$ref_number);
        }
        for ($i=14; $i < 28; $i++) { 
            $ref_number = $i+1-14;
            $cars[$i] = $this->getReference('Car'.$ref_number);
        }
        for ($i=0; $i < 28; $i++) { 
            $ad = new Ad();
            $ad->setOwnerName('Ivan');
            $ad->setOwnerCity('Moscow');
            $ad->setPrice(mt_rand(500000,2000000));
            $ad->setCar($cars[$i]);
            $ad->setCarProducer($cars[$i]->getProducer());
            $ad->setCarModel($cars[$i]->getModel());
            $ad->setCarYear($cars[$i]->getYear());
            $manager->persist($ad);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CarFixtures::class,
        );
    }
}