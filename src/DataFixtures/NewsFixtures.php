<?php

namespace App\DataFixtures;

use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NewsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $news1 = new News();
        $news1->setTitle($faker->words(3, true));
        $news1->setDescription($faker->words(15, true));
        $manager->persist($news1);

        $news2 = new News();
        $news2->setTitle($faker->words(3, true));
        $news2->setDescription($faker->words(15, true));
        $manager->persist($news2);

        $news3 = new News();
        $news3->setTitle($faker->words(3, true));
        $news3->setDescription($faker->words(15, true));
        $manager->persist($news3);

        $manager->flush();
    }
}
