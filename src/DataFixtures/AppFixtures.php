<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\Wish;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->addCategories($manager);
        $this->addWishes($manager);
    }

    public function addCategories(ObjectManager $manager): void
    {
//
        $categories = ['Travel & Adventure', 'Sport', 'Entertainment', 'Human Relations', 'Others'];

        foreach ($categories as $cate) {
            $category = new Category();
            $category->setName($cate);
            $manager->persist($category);
        }
        $manager->flush();
    }

    public function addWishes(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $categories = $manager->getRepository(Category::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();

        for ($i = 0; $i < 50; $i++) {
            $wish = new Wish();

            $wish
                ->setTitle('Devenir ' . $faker->jobTitle())
                ->setDescription($faker->sentence(10))
                ->setUser($faker->randomElement($users))
                ->setIsPublished($faker->boolean(false))
                ->setDateCreated($faker->dateTimeBetween('-30 days'))
                ->setDateUpdated($faker->dateTimeBetween($wish->getDateCreated()))
                ->setCategory($faker->randomElement($categories));

            $manager->persist($wish);
        }

        $manager->flush();
    }
}
