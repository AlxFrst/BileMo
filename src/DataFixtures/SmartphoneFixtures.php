<?php

namespace App\DataFixtures;

use App\Entity\Smartphone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Uid\Uuid;

class SmartphoneFixtures extends Fixture
{

    
    /**
     * load function to push fake data in bdd. Fake smartphones are created here.
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 40; $i++) {
            $smartphone = new Smartphone();
            $smartphone->setName("Smartphone ".$i);
            $smartphone->setDescription("Caractéristique: ".$i);
            $smartphone->setBrand("Iphone ".$i);
            $smartphone->setPrice(rand(500, 1500));
            $smartphone->setUuid(Uuid::v6());
            $manager->persist($smartphone);
        }

        $manager->flush();


    }
}