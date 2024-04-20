<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Pour utiliser faker
use Faker\Factory;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 25; $i++) {

            $project = new Project();
            $project->setProjClient($faker->userName());
            $project->setProjPrice($faker->randomNumber(7, false));
            $project->setProjCategory($faker->word());
            $project->setProjDate($faker->DateTime());
            $project->setProjFacebook($faker->url());
            $project->setProjTwitter($faker->url());
            $project->setProjLinkedin($faker->url());
            $project->setProjInstagram($faker->url());
            $project->setProjTitle($faker->sentence());
           
            $manager->persist($project);
            };

        $manager->flush();
    }
}
