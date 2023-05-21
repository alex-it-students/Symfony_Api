<?php

namespace App\DataFixtures;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

/**
 * @Group("country")
 */
class CountryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        // utiliser faker pour générer 10 pays et les codes ISO correspondant
         $faker = Faker\Factory::create('fr_FR');
         for ($i = 0; $i < 50; $i++) {
             $country = new Country();
             $country->setName($faker->country);
             $country->setIsoCode($faker->countryCode);
             $manager->persist($country);
         }

         $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['country'];
    }
}
