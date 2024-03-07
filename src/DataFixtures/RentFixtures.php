<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Rent;
// Pour utiliser faker
use Faker\Factory;

class RentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create('fr_FR');

        // for ($i = 0; $i < 25; $i++) {

        //     $rent = new Rent();
        //     $rent->setRentStart($faker->dateTime());
        //     $rent->setRentEnd($faker->dateTime());
        //     $rent->setRentPrice($faker->randomFloat(2,0,99999999));
        //     $rent->setRentUser();
        //     $rent->setRentProperty();
           
        //     $manager->persist($rent);
        // };

        $manager->flush();
    }
}
