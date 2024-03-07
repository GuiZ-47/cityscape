<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Picture;
// Pour utiliser faker
use Faker\Factory;


class PictureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create('fr_FR');

        // for ($i = 0; $i < 25; $i++) {

        //     $picture = new Picture();
        //     $picture->setPicFile($faker->word());
        //     $picture->setPicName($faker->word());
        //     $picture->setPicHref($faker->mimeType().'.'.$faker->fileExtension());
        //     $picture->setPicAlt($faker->sentence());
        //     $picture->setPicCaption($faker->sentence());
        //     $picture->setPicType($faker->word());
        //     $picture->setPicFormat($faker->fileExtension());
        //     $picture->setPicWidth($faker->randomNumber(5,false));
        //     $picture->setPicHeight($faker->randomNumber(5,false));
        //     $picture->setPicSize($faker->randomFloat(2,0,99999999));
        //     $picture->setPicProperty();
           
        //     $manager->persist($picture);
        // };

        // $manager->flush();
    }
}
