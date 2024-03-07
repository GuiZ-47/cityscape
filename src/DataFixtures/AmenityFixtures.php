<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Amenity;
// Pour utiliser faker
use Faker\Factory;

class AmenityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create('fr_FR');

        // for ($i = 0; $i < 25; $i++) {

        //     $amenity = new Amenity();
        //     $amenity->setAmDishwasher($faker->numberBetween(0,1));
        //     $amenity->setAmFloorCoverings($faker->numberBetween(0,1));
        //     $amenity->setAmInternet($faker->numberBetween(0,1));
        //     $amenity->setAmWardrobes($faker->numberBetween(0,1));
        //     $amenity->setAmSupermarket($faker->numberBetween(0,1));
        //     $amenity->setAmKidsZone($faker->numberBetween(0,1));
        //     $amenity->setAmPropId();
           
        //     $manager->persist($amenity);
        //     };
        // $manager->flush();
    }
}
