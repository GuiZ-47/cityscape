<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Address;
// Pour utiliser faker
use Faker\Factory;

class AddressFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create('fr_FR');

        // for ($i = 0; $i < 25; $i++) {

        //     $address = new Address();
        //     $address->setAddNbStreet($faker->randomNumber(5, false).' '.$faker->randomElement(['', 'Bis', 'Ter']));
        //     $address->setAddLine1($faker->sentence(2));
        //     $address->setAddLine2($faker->secondaryAddress());
        //     $address->setAddCity($faker->word());
        //     $address->setAddState($faker->region());
        //     $address->setAddZip($faker->departmentNumber());
        //     $address->setAddProperty();
        //     $address->setAddCountry();
           
        //     $manager->persist($address);
        // };

        // $manager->flush();
    }
}
