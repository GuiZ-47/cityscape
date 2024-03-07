<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Feature;
// Pour utiliser faker
use Faker\Factory;

class FeatureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 25; $i++) {

            // $feature = new Feature();
            // $feature->setFeatTitle($faker->sentence());
            // // $feature->setFeatProperty();
           
            // $manager->persist($feature);
            // };

        $manager->flush();
        }
    }
}