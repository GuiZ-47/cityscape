<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Country;
// Pour utiliser faker
use Faker\Factory;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 25; $i++) {

            $country = new Country();
            $country->setCtName($faker->countryCode());
           
            $manager->persist($country);
        };

        $manager->flush();
    }
}
