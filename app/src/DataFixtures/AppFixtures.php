<?php

namespace App\DataFixtures;

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
        $manager->flush();
    }
}
