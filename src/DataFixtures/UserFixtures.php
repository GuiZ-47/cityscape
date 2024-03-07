<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Pour utiliser faker
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 25; $i++) {

            $user = new User();
            $user->setEmail($faker->email());
            $user->setPassword($faker->password());
            $user->setIsVerified($faker->numberBetween(0,1));
            $user->setFirstName($faker->userName());
            $user->setLastName($faker->userName());
            $user->setUserName($faker->userName());
           
            $manager->persist($user);
            };
            
    $manager->flush();
    }
}
