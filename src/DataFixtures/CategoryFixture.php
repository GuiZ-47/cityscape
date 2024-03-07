<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Pour utiliser faker
use Faker\Factory;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Factory::create('fr_FR');

        $categories = [
            [
                'main_categories' => 'Page',
                'sub_category_array' => [
                    'Property',
                    'Property Sidebar',
                    'Property Details',
                    'Add New Listing',
                    'About Us',
                    'FAQ',
                    'CheckOut',
                    'Cart'
                ]
            ],
        
            [
                'main_categories' => 'Projects',
                'sub_category_array' => [
                    'Project',
                    'Project Details'
                ]
            ],
        
            [
                'main_categories' => 'Blog',
                'sub_category_array' => [
                    'Blog Classic',
                    'Blog Details'
                ]
            ],
        
            [
                'main_categories' => 'Contact Us',
                'sub_category_array' => []
            ],
        
        ];

        foreach ($categories as $sub_array) {
            
            $maincategory = new Category();
            $maincategory->setName($sub_array['main_categories']);
            $maincategory->setSlug($faker->shuffle('hello-world'));
            $maincategory->setMetaTitle($faker->sentence());
            $maincategory->setMetaDescription($faker->sentence());
            $manager->persist($maincategory);
            
            foreach ($sub_array['sub_category_array'] as $subcategory_name) {
                $subcategory = new Category();
                $subcategory->setName($subcategory_name);
                $subcategory->setSlug($faker->shuffle('hello-world'));
                $subcategory->setMetaTitle($faker->sentence());
                $subcategory->setMetaDescription($faker->sentence());
                $subcategory->setParent($maincategory);
                $manager->persist($subcategory);
            };

            $manager->flush();
        }
        ;
    }
}
