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

        for($i = 0; $i < 12; $i++) {
            $news = new News();
            $news->setTitle($faker->words(3, true));
            $news->setDescription($faker->words(15, true));

            $content = "";
            foreach($faker->paragraphs() as $p){
                $content = $content . "<p>" . $p . "</p>";
            }
            $news->setContent($content);

            $manager->persist($news);
        }

        $manager->flush();
    }
}
