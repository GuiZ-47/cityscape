<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Pour utiliser faker
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // ------------------Version perso -----------------------
        // $categories = [
        //     1 => [
        //         'main_categories' => 'Page',
        //         'sub_category_array' => [
        //             'Property',
        //             'Property Sidebar',
        //             'Property Details',
        //             'Add New Listing',
        //             'About Us',
        //             'FAQ',
        //             'CheckOut',
        //             'Cart'
        //         ]
        //     ],

        //     2 => [
        //         'main_categories' => 'Projects',
        //         'sub_category_array' => [
        //             'Project',
        //             'Project Details'
        //         ]
        //     ],

        //     3 => [
        //         'main_categories' => 'Blog',
        //         'sub_category_array' => [
        //             'Blog Classic',
        //             'Blog Details'
        //         ]
        //     ],

        //     4 => [
        //         'main_categories' => 'Contact Us',
        //         'sub_category_array' => []
        //     ],

        // ];

        // foreach ($categories as $z => $sub_array) {
        //     $maincategory = new Category();
        //     $maincategory->setName($sub_array['main_categories']);
        //     $maincategory->setSlug($faker->shuffle('hello-world'));
        //     $maincategory->setMetaTitle($faker->sentence());
        //     $maincategory->setMetaDescription($faker->sentence());

        //     $manager->persist($maincategory);

        //     $this->addReference('category_' . $z, $maincategory);

        //     foreach ($sub_array['sub_category_array'] as $k => $subcategory_name) {
        //         $subcategory = new Category();
        //         $subcategory->setName($subcategory_name);
        //         $subcategory->setSlug($faker->shuffle('hello-world'));
        //         $subcategory->setMetaTitle($faker->sentence());
        //         $subcategory->setMetaDescription($faker->sentence());
        //         $subcategory->setParent($maincategory);
        //         $manager->persist($subcategory);

        //     }

        // }

        // Version de Guillaume : categories pour une agence immobilière
        $category = [
            1 => [
                'name' => 'Vente',
                'description' => 'Vente de biens immobiliers',
                'slug' => 'vente',
                'parent' => [
                    1 => [
                        'name' => 'Maison',
                        'description' => 'Vente de maisons',
                        'slug' => 'maison',
                    ],
                    2 => [
                        'name' => 'Appartement',
                        'description' => 'Vente d\'appartements',
                        'slug' => 'appartement',
                    ],
                    3 => [
                        'name' => 'Terrain',
                        'description' => 'Vente de terrains',
                        'slug' => 'terrain',
                    ],
                    4 => [
                        'name' => 'Local commercial',
                        'description' => 'Vente de locaux commerciaux',
                        'slug' => 'local-commercial',
                    ],
                    5 => [
                        'name' => 'Immeuble',
                        'description' => 'Vente d\'immeubles',
                        'slug' => 'immeuble',
                    ],
                    6 => [
                        'name' => 'Fonds de commerce',
                        'description' => 'Vente de fonds de commerce',
                        'slug' => 'fonds-de-commerce',
                    ],
                ],

            ],
            2 => [
                'name' => 'Location',
                'description' => 'Location de biens immobiliers',
                'slug' => 'location',
                'parent' => [
                    1 => [
                        'name' => 'Maison',
                        'description' => 'Location de maisons',
                        'slug' => 'maison',
                    ],
                    2 => [
                        'name' => 'Appartement',
                        'description' => 'Location d\'appartements',
                        'slug' => 'appartement',
                    ],
                    3 => [
                        'name' => 'Terrain',
                        'description' => 'Location de terrains',
                        'slug' => 'terrain',
                    ],
                    4 => [
                        'name' => 'Local commercial',
                        'description' => 'Location de locaux commerciaux',
                        'slug' => 'local-commercial',
                    ],
                    5 => [
                        'name' => 'Immeuble',
                        'description' => 'Location d\'immeubles',
                        'slug' => 'immeuble',
                    ],
                    6 => [
                        'name' => 'Fonds de commerce',
                        'description' => 'Location de fonds de commerce',
                        'slug' => 'fonds-de-commerce',
                    ],
                ]
            ],
            3 => [
                'name' => 'Gestion',
                'description' => 'Gestion de biens immobiliers',
                'slug' => 'gestion',
                'parent' => [
                    1 => [
                        'name' => 'Gestion locative',
                        'description' => 'Gestion locative',
                        'slug' => 'gestion-locative',
                    ],
                    2 => [
                        'name' => 'Gestion de copropriété',
                        'description' => 'Gestion de copropriété',
                        'slug' => 'gestion-de-copropriete',
                    ],
                ]
            ],
        ];

        foreach ($category as $key => $value) {
            $category = new Category();
            $category->setName($value['name']);
            $category->setSlug($value['slug']);
            $manager->persist($category);
            if (isset($value['parent'])) {
                foreach ($value['parent'] as $k => $v) {
                    $parent = new Category();
                    $parent->setName($v['name']);
                    $parent->setSlug($v['slug']);
                    $parent->setParent($category);
                    $manager->persist($parent);
                    $this->setReference('category_' . $k, $parent);

                }
            }
        }

        $manager->flush();
    }
}