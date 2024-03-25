<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Reseller;
use App\Entity\Smartphone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Uid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        // loop 30 time
        for ($i = 0; $i < 30; $i++) {
            $smartphone = new Smartphone();
            $smartphone->setName('Smartphone ' . $i);
            $smartphone->setDescription('Description ' . $i);
            $smartphone->setBrand('iPhone ' . $i);
            // set random price between 550 and 1999
            $smartphone->setPrice(rand(550, 1999));
            $smartphone->setUuid(Uuid::v6());
            $manager->persist($smartphone);
        }

        for ($i = 0; $i < 10; $i++) {
            $reseller = new Reseller();
            $reseller->setFirstName('Alex' . $i);
            $reseller->setLastName('Forestier' . $i);
            $reseller->setEmail('alex' . $i . '@gmail.com');
            $customer->setUuid(Uuid::v6());
            $manager->persist($reseller);
        }

        $manager->flush();
    }
}
