<?php

namespace App\DataFixtures;

use App\Entity\Reseller;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

class ResellerFixtures extends Fixture
{
    /**
     * Constant to reference load order
     *
     */
    public const RESELLER_REFERENCE = 'reseller';
    /**
     * UserPasswordHasher to Hash Password before bdd push
     *
     * @var [Hasher]
     */
    private $userPasswordHasher;
    
    /**
     * Constructor to use UserPassxordHAsher interface as Injection dependancy
     *
     * @param UserPasswordHasherInterface $userPasswordHasher
     */
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    /**
     * load function to push fake data in bdd. Here Reseller with default company name and all random properties are reated and pass to the manager.
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $companies = [
            'Tech Innovators', 'Digital Solutions', 'Mobile Experts', 
            'High-End Devices', 'Smart World', 'Future Tech', 
            'Telecom Partners', 'NextGen Electronics', 'Smart Gadgets', 'Premier Mobiles'
        ];
        $domains = [
            'tech-innovators.com', 'digital-solutions.com', 'mobile-experts.com', 
            'high-end-devices.com', 'smart-world.com', 'future-tech.com', 
            'telecom-partners.com', 'nextgen-electronics.com', 'smart-gadgets.com', 'premier-mobiles.com'
        ];

        // Create specific test reseller
        $testReseller = new Reseller();
        $testReseller->setEmail('test@test.com');
        $testReseller->setCompanyName('Test Company');
        $testReseller->setRoles(["ROLE_ADMIN"]);
        $testReseller->setUuid(Uuid::v6());
        $testReseller->setPassword($this->userPasswordHasher->hashPassword($testReseller, 'test'));
        $this->addReference('reseller_test', $testReseller);
        $manager->persist($testReseller);

        for ($i = 0; $i < 15; $i++) {
            $reseller = new Reseller();
            $companyName = $companies[array_rand($companies)];
            $domain = $domains[array_rand($domains)];
            $email = strtolower(str_replace(' ', '.', $companyName)) . ".$i@$domain";
            
            $reseller->setEmail($email);
            $reseller->setCompanyName($companyName);
            $reseller->setRoles(["ROLE_USER"]);
            $reseller->setUuid(Uuid::v6());
            $reseller->setPassword($this->userPasswordHasher->hashPassword($reseller, "sdqqfdsrfser"));
            $this->addReference('reseller_' . $i, $reseller);
            $manager->persist($reseller);
        }

        $manager->flush();
    }
}
