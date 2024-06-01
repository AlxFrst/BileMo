<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Uid\Uuid;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    private $firstNames = [
        'Alexandre', 'Brigitte', 'Charles', 'Dominique', 'Élodie', 'François', 'Gabrielle', 'Hugo', 'Isabelle', 'Jean'
    ];

    private $lastNames = [
        'Dupont', 'Martin', 'Bernard', 'Robert', 'Petit', 'Durand', 'Leroy', 'Moreau', 'Simon', 'Laurent'
    ];

    private $streets = [
        'rue de la Paix', 'avenue des Champs-Élysées', 'boulevard Saint-Germain', 'rue du Faubourg Saint-Honoré', 'rue de Rivoli'
    ];

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 100; $i++) {
            $firstName = $this->firstNames[array_rand($this->firstNames)];
            $lastName = $this->lastNames[array_rand($this->lastNames)];
            $email = strtolower($firstName) . "." . strtolower($lastName) . ($i + 1) . "@example.com";
            $address = mt_rand(1, 100) . " " . $this->streets[array_rand($this->streets)];

            $customer = new Customer();
            $customer->setFirstName($firstName);
            $customer->setLastName($lastName);
            $customer->setEmail($email);
            $customer->setFacturationAddress($address);

            // Set the start and end dates for the range.
            $start = strtotime('2024-01-01 00:00:00');
            $end = strtotime('2024-12-31 00:00:00');
            // Generate a random timestamp within the range.
            $randomTimestamp = mt_rand($start, $end);

            // Create a DateTime object from the random timestamp.
            $randomDate = new DateTimeImmutable();
            $customer->setCreatedAt($randomDate->setTimestamp($randomTimestamp));
            $customer->setUuid(Uuid::v6());
            $customer->setReseller($this->getReference('reseller_' . mt_rand(0, 14)));
            $manager->persist($customer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ResellerFixtures::class,
        ];
    }
}
