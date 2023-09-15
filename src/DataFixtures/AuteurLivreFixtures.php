<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Livre;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AuteurLivreFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {   
//1. obtenir tous les livres de la base de donnees

        $repoLivres = $manager->getRepository(Livre::class);
        $ArrayObjLivres = $repoLivres->findAll();

//2.Obtenir tous les Auteurs
        $repoAuteurs = $manager->getRepository(Auteur::class);
        $ArrayObjAuteurs = $repoAuteurs->findAll();


//3.Parcourir tous les livres, pour chaque livre, rajouter (add) un Auteur aleatoire
//mt_rand is better than rand() because it uses the Mersenne Twister algorythm (more random and improved)
        foreach($ArrayObjLivres as $livre){
            $livre->addAuteur($ArrayObjAuteurs[mt_rand(0, count($ArrayObjAuteurs)-1)]);
            $manager->persist($livre);
        }
        $manager->flush();
    }
    //fixer les dependances de cette fixture
    public function getDependencies():array
    {
        return [
            AuteurFixtures::class,
            LivreFixtures::class,
        ];
    }
}
