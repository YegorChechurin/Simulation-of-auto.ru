<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Car;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $producers = [
        	'Suzuki','Suzuki','Mazda','Mazda','Toyota','Toyota',
        	'BMW','BMW','Volkswagen','Volkswagen',
        	'Hyandai','Hyandai','Kia','Kia'
        ];

        $models = [
        	'SX4','Grand Vitara','3','6','Corolla','Camri',
        	'X5','X6','Polo','Jetta',
        	'Solaris','Elantra','Rio','Optima'
        ];

        for ($i=0; $i < 14; $i++) { 
        	$years[$i] = mt_rand(2000,2018);
        }

        $body_styles = [
        	'hatchback','crossover','sedan','sedan','sedan','sedan',
        	'crossover','crossover','sedan','sedan',
        	'sedan','sedan','sedan','sedan'
        ];

        $number_of_doors = array_fill(0, 14, 4);
        
        for ($i=0; $i < 14; $i++) { 
        	$max_speeds[$i] = mt_rand(150,200);
        }
        
        for ($i=0; $i < 14; $i++) { 
        	$volume_raw = 1.6 + mt_rand() / mt_getrandmax() * (3 - 1.6);
        	$volume = round($volume_raw,1);
        	$engine_volumes[$i] = $volume; 
        }
        
        for ($i=0; $i < 14; $i++) { 
        	$fuel_consumption[$i] = mt_rand(8,20);
        }
        
        $producer_countries = [
        	'Japan','Japan','Japan','Japan','Japan','Japan',
        	'Germany','Germany','Germany','Germany',
        	'Korea','Korea','Korea','Korea'
        ];

        for ($i=0; $i < 14; $i++) { 
        	$car = new Car();
        	$car->setProducer($producers[$i]);
        	$car->setModel($models[$i]);
        	$car->setYear($years[$i]);
        	$car->setBodyStyle($body_styles[$i]);
        	$car->setNumberOfDoors($number_of_doors[$i]);
        	$car->setMaxSpeed($max_speeds[$i]);
        	$car->setEngineVolume($engine_volumes[$i]);
        	$car->setFuelConsumption($fuel_consumption[$i]);
        	$car->setProducerCountry($producer_countries[$i]);
            $ref_number = $i+1;
            $this->addReference('Car'.$ref_number, $car);
        	$manager->persist($car);
        }

        $manager->flush();
    }
}
