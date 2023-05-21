<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use MartialArtProvider;
use AnimalNameProvider;

class AnimalFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new MartialArtProvider($faker));
        $faker->addProvider(new AnimalNameProvider($faker));

        $countries = $manager->getRepository(Country::class)->findAll();

        for ($i = 0; $i < 10; $i++) {
            $animal = new Animal();
            $animal->setName($faker->animalName());
            $animal->setCountry($faker->randomElement($countries));
            $animal->setAverageSize($faker->numberBetween(1, 5000));
            $animal->setAverageLifeExpectency($faker->numberBetween(4, 300));
            $animal->setPhoneNumber($faker->phoneNumber);
            $animal->setMartialArt($faker->martialArt());
            $manager->persist($animal);
        }
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [CountryFixtures::class];
    }

    public static function getGroups(): array
    {
        return ['animal'];
    }
}
