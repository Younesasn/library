<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $book = new Book();
            $book->setTitle($faker->sentence(2));
            $book->setAuthor($faker->name());
            $book->setDescription($faker->paragraph());
            $book->setCreatedAt(new \DateTime());
            $manager->persist($book);
        }

        $user = new User();
        $user->setUsername('user');
        $user->setPassword('user');
        $user->setFirstname($faker->firstName());
        $user->setLastname($faker->lastName());
        $manager->persist($user);

        $manager->flush();
    }
}
