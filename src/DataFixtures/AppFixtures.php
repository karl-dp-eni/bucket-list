<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $wish = new Wish();
            $wish
                ->setTitle('Devenir ' . $faker->jobTitle())
                ->setDescription($faker->sentence(10))
                ->setAuthor($faker->name())
                ->setIsPublished($faker->boolean(false))
                ->setDateCreated($faker->dateTimeBetween('-30 days'))
                ->setDateUpdated($faker->dateTimeBetween($wish->getDateCreated()));

            $manager->persist($wish);
        }

        $manager->flush();
    }
}
