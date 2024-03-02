<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        // WIP pour Fixture
        // $category =[
        //     Pages =>['Property', 'Property Sidebar', 'Property Details','Add new Listing','About Us','FAQ', 'Checkout','Cart','Rent'],
        //     Project =>['Project Side','Project Details'],
        //     Blog =>['Blog Classic','Blog Details'],
        //     Contact,
        // ];
        
        // $c=[
        //     1=>[
        //         'title'=>'',
        //         'slug'=> '',
        //         'description'=> '',
        //         'parent'=> [
        //         ],
        //        [] ,
        // ];

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

