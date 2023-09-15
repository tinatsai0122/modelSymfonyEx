<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
//faker
use Faker;
;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Faker\Factory::create();//default in English
        for ($i =0; $i<20;$i++){
            $auteur = new Auteur(["nom" =>$faker->name() ,
                                    "nationalite" => $faker->country() ,
            ]);
            $manager->persist($auteur);//prepare to inject in db
        }
        // $product = new Product();
        // $manager->persist($product);
        $manager->flush();//inject in db
    }
}
