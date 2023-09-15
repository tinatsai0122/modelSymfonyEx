<?php

namespace App\DataFixtures;

use App\Entity\Emprunt;
use App\Entity\Client;
use App\Entity\Exemplaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
//faker
use Faker;
;

class EmpruntFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {   
        $faker = Faker\Factory::create();//default in English
        
        //obtenir client au hasard a l'emprunt
        $repoClient = $manager->getRepository(Client::class);
        $ArrayObjClients = $repoClient->findAll();
        
        //obtenir exemplaire au hasard a l'emprunt
        $repoExemplaire = $manager->getRepository(Exemplaire::class);
        $ArrayObjExemplaires = $repoExemplaire->findAll();
        
        
        for ($i =0; $i<20;$i++){
            
            $dateEmprunt = $faker->dateTime();
    //date retour = date emprunt + 28 jours
            $dateRetourPreve = clone $dateEmprunt;
            $dateRetourPreve->modify('+25 days');
            $dateRetourReelle = clone $dateEmprunt;
            $dateRetourReelle->modify('+' .mt_rand(1, 40) . 'days');


            $emprunt = new Emprunt(["dateEmprunt" =>$dateEmprunt ,
            "dateRetourPreve" => $dateRetourPreve ,
            "dateRetourReelle" => $dateRetourReelle,
        ]);
        $emprunt->setClient($ArrayObjClients[mt_rand(0, count($ArrayObjClients)-1)]);
        $emprunt->setExemplaire($ArrayObjExemplaires[mt_rand(0, count($ArrayObjExemplaires)-1)]);
        //associer un client au hasard a l'emprunt & un exemplaire au hasard a l'emprunt
        $manager->persist($emprunt);//prepare to inject in db
    }
        
        $manager->flush();//inject in db
    }
}
