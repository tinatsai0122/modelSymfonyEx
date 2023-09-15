<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $client = new Client([
                "nom" => $faker->name(),
                "prenom" => $faker->firstName(),
                "email" => $faker->email(),
            ]);
            $manager->persist($client);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
