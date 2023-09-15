<?php

namespace App\DataFixtures;

use App\Entity\Livre;
use App\Entity\Exemplaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class ExemplaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //obtenir tous les livres de la base de donnees
        $repoLivres = $manager->getRepository(Livre::class);
        $ArrayObjLivres = $repoLivres->findAll();

        $etats = ['bon', 'mauvais', 'tres abime'];
        for ($i = 0; $i < 20; $i++) {
            $indexEtat = mt_rand(0, count($etats) - 1);//index aleatoire array etats
            //create de l'exemplaire sans Livre associe 
            $exemplaire = new Exemplaire(
              [
                   "etat" => $etats[$indexEtat],
                ]
            );
            //associer un Livre au hasard a l'exemplaire
            $indexLivre = mt_rand(0, count($ArrayObjLivres) - 1); //index au hasard
            //prendre le livre qui se trouve dans cet index
            $randomLivre = $ArrayObjLivres[$indexLivre];
            //fixer le Livre ( 1 seul) a l'exemplaire
            $exemplaire->setLivre($ArrayObjLivres[$indexLivre]);
//            $exemplaire->setLivre($ArrayObjLivres[mt_rand(0, count($ArrayObjLivres) - 1)]);

            $manager->persist($exemplaire);
        }

        $manager->flush();
    }
}
