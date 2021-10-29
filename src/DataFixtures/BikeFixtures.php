<?php

namespace App\DataFixtures;

use App\Entity\Bike;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BikeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $category1 = new Category();
        $category1->setName("mountain");
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName("road");
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName("city");
        $manager->persist($category3);

        for($i = 0; $i < 30; $i++) {
            $bike = new Bike();
            $bike->setName($faker->words(3, true));
            $bike->setDescription($faker->words(40, true));
            $bike->setPrice($faker->randomFloat(2, 1000.0, 10000.0));

            if($i % 12 == 0)$bike->setCount(0);
            else $bike->setCount(100);

            if($i % 3 == 0) $bike->setCategory($category3);
            elseif ($i % 2 == 0) $bike->setCategory($category2);
            else $bike->setCategory($category1);

            $manager->persist($bike);
        }

        $manager->flush();
    }
}
