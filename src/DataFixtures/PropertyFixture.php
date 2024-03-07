<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Pour utiliser faker
use Faker\Factory;



class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 25; $i++) {

        $faker = Factory::create('fr_FR');

        $property = new Property();
        $property->setPropHousingType($faker->randomElement(['Houses','Apartments','Office','Villa']));
        $property->setPropNbRooms($faker->numberBetween(0,30));
        $property->setPropSqm($faker->numberBetween(0,1000));
        $property->setPropPrice($faker->numberBetween(0,100000));
        $property->setCreatedAt(new \DateTimeImmutable());
        $property->setPropNbBeds($faker->numberBetween(0,10));
        $property->setPropNbBaths($faker->numberBetween(0,10));
        $property->setPropNbSpaces($faker->numberBetween(0,10));
        $property->setPropFurnished($faker->numberBetween(0,1));
        $manager->persist($property);
        };
        
        $manager->flush();
    }
}
