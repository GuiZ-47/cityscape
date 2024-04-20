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

    }
}
