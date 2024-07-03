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

        $user = new User();
        $user->setUsername('user');
        $user->setPassword('user');
        $user->setFirstname($faker->firstName());
        $user->setLastname($faker->lastName());
        $manager->persist($user);

        $test = new User();
        $test->setUsername('test');
        $test->setPassword('test');
        $test->setFirstname($faker->firstName());
        $test->setLastname($faker->lastName());
        $manager->persist($test);

        for ($i = 0; $i < 9; $i++) {
            $book = new Book();
            $book->setTitle($faker->sentence(2));
            $book->setAuthor($faker->name());
            $book->setDescription($faker->paragraph());
            $book->setCreatedAt(new \DateTime());
            $book->setCreatedBy($user);
            $manager->persist($book);
        }

        $manager->flush();
    }
}
