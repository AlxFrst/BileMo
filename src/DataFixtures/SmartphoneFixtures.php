<?php

namespace App\DataFixtures;

use App\Entity\Smartphone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class SmartphoneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brands = ['Apple', 'Samsung', 'Google', 'OnePlus', 'Xiaomi', 'Sony', 'Huawei', 'Oppo', 'Nokia', 'Asus'];
        $names = ['Pro', 'Max', 'Ultra', 'Plus', 'Lite', 'Edge', 'Note', 'S', 'X', 'Z'];
        $features = [
            'Écran 6,1 pouces, puce A15 Bionic, compatible 5G, système à triple caméra',
            'Écran 6,2 pouces, Exynos 2100/Snapdragon 888, compatible 5G, système à triple caméra',
            'Écran 6,4 pouces, Google Tensor, compatible 5G, système à double caméra',
            'Écran 6,7 pouces, Snapdragon 888, compatible 5G, système à quadruple caméra',
            'Écran 6,81 pouces, Snapdragon 888, compatible 5G, système à triple caméra',
            'Écran 6,5 pouces, Snapdragon 888, compatible 5G, système à quadruple caméra',
            'Écran 6,6 pouces, Kirin 9000, compatible 5G, système à quadruple caméra',
            'Écran 6,7 pouces, Snapdragon 888, compatible 5G, système à quadruple caméra',
            'Écran 6,81 pouces, Snapdragon 765G, compatible 5G, système à quadruple caméra',
            'Écran 6,78 pouces, Snapdragon 888, compatible 5G, système à triple caméra, fonctionnalités gaming'
        ];
        $basePrices = [699.99, 799.99, 899.99, 999.99, 1099.99, 1199.99];

        $count = 100; // Nombre de smartphones à générer

        for ($i = 0; $i < $count; $i++) {
            $brand = $brands[array_rand($brands)];
            $name = $brand . ' ' . $names[array_rand($names)] . ' ' . ($i + 1);
            $description = $features[array_rand($features)];
            $price = $basePrices[array_rand($basePrices)] + mt_rand(0, 100);

            $smartphone = new Smartphone();
            $smartphone->setName($name);
            $smartphone->setDescription($description);
            $smartphone->setBrand($brand);
            $smartphone->setPrice($price);
            $smartphone->setUuid(Uuid::v6());
            $manager->persist($smartphone);
        }

        $manager->flush();
    }
}
