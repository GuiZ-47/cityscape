<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Pour utiliser faker
use Faker\Factory;



class PropertyFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($ii = 1; $ii < 5; $ii++) {

            $property = new Property();
            $property->setPropHousingType($faker->randomElement(['Houses', 'Apartments', 'Office', 'Villa']));
            $property->setPropNbRooms($faker->numberBetween(0, 30));
            $property->setPropSqm($faker->numberBetween(0, 1000));
            $property->setPropPrice($faker->numberBetween(0, 100000));
            $property->setPropNbBeds($faker->numberBetween(0, 10));
            $property->setPropNbBaths($faker->numberBetween(0, 10));
            $property->setPropNbSpaces($faker->numberBetween(0, 10));
            $property->setPropFurnished($faker->numberBetween(0, 1));
            $property->setCategory($this->getReference('category_' . rand(1, 2)));
            $manager->persist($property);

            for ($i = 0; $i < 2; $i++) {

                $url = 'https://picsum.photos/1290/584';
                $imagename = rand(1, 1000) . '.jpg';
                $img = 'C:\laragon\www\cityscape\public\assets\images\biens/' . $imagename;
                file_put_contents($img, file_get_contents($url));

                $pict = new Picture();
                $pict->setImageName($imagename);
                $pict->setProperty($property);

                $manager->persist($pict);
            }
            ;


        }

        $manager->flush();
    }
}