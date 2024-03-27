<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

// Pour utiliser faker
use Faker\Factory;



class PropertyFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // comme file_get_contents() ne fonctionne pas, on utilise cette fonction à la place
        function curl_get_contents($url)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }

        for ($ii = 1; $ii <100; $ii++) {

            $property = new Property();
            $property->setPropTitle($faker->word());
            $property->setPropSlug($property->getPropTitle());
            $property->setPropDescription($faker->text(200));
            $property->setPropHousingType($faker->randomElement(['Houses', 'Apartments', 'Office', 'Villa']));
            $property->setPropSqm($faker->numberBetween(0, 1000));
            $property->setPropPrice($faker->numberBetween(0, 1000));
            
            $property->setPropNbRooms($faker->numberBetween(0, 30));
            $property->setPropNbBeds($faker->numberBetween(1, 10));
            $property->setPropNbBaths($faker->numberBetween(1, 5));
            $property->setPropNbSpaces($faker->numberBetween(0, 10));

            $property->setPropFurnished($faker->numberBetween(0, 1));

            $property->setPropLatitude($faker->latitude);
            $property->setPropLongitude($faker->longitude);

            $featArray =[];
            for ($i = 1; $i < rand(1, 8); $i++) {
                $featArray[] = $faker->sentence;
            }           
            $property->setPropFeature($featArray);
            
            // Récupération des références pour les liaisons
            // Le premier rand() est à 1,2 et pas 1,3, on n'associe pas les catégories de gestion aux propriétés, c'est plus simple car ils n'y a que 2 sous-catégories dans la gestion au lieu de 6 pour la location/vente
            $property->setCategory($this->getReference('category_' . rand(1, 2). rand(1, 6) ));
            $property->setAgentImmobilier($this->getReference('agent'));

            $manager->persist($property);

            for ($i = 0; $i < rand(1, 3); $i++) {

                // Récupérer une image sur internet et la sauvegarder dans un dossier

                $url = 'https://picsum.photos/1290/584';
                $imageName ="property". rand(1, 9999) . '.jpg';

                while (!file_exists('C:\laragon\www\cityscape\public\assets\images\property/' . $imageName)) {
                    $imageFile = curl_get_contents($url);
                    $imagePath = 'C:\laragon\www\cityscape\public\assets\images\property/' . $imageName;
    
                    file_put_contents($imagePath, $imageFile );
                }


                $pict = new Picture();
                $pict->setImageName($imageName);
                $pict->setProperty($property);

                $manager->persist($pict);
            }
            ;


        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];

    }
}