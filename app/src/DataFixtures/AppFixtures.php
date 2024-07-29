<?php

namespace App\DataFixtures;

use App\Entity\ExtincteurType;
use App\Entity\Status;
use App\Entity\TypeIntervention;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $enCours = new Status();
        $enCours->setLabel('en cours');

        $terminer = new Status();
        $terminer->setLabel('terminée');

        $valider = new Status();
        $valider->setLabel('validée');

        $manager->persist($enCours);
        $manager->persist($terminer);
        $manager->persist($valider);

        $maintenance = new TypeIntervention();
        $pose = new TypeIntervention();
        $maintenance->setLabel('maintenance');
        $pose->setLabel('pose');

        $manager->persist($pose);
        $manager->persist($maintenance);

        $eau = new ExtincteurType();
        $co2 = new ExtincteurType();
        $poudre = new ExtincteurType();

        $eau->setLabel('eau');
        $co2->setLabel('co2');
        $poudre->setLabel('poudre');

        $manager->persist($eau);
        $manager->persist($co2);
        $manager->persist($poudre);
        


        $manager->flush();
    }
}
