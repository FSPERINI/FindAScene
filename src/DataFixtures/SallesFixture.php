<?php

namespace App\DataFixtures;

use App\Entity\Salles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class SallesFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i =0; $i < 100; $i++){
            $salle = new Salles();
            $salle
            ->setNomSalle($faker->words(4, true))
            ->setNomRef($faker->firstName)
            ->setVille($faker->city)
            ->setPassword('demo')
            ->setAdresse($faker->address)
            ->setMail($faker->freeEmail)
            ->setTel($faker->numberBetween(1,900))
            ->setCapacite($faker->numberBetween(1000,9000))
            ->setCategorie($faker->word)
            ->setBackline($faker->word)
            ->setSlug($faker->word)
            ->setDescription($faker->sentences( 10 , true))
            ;
            $manager->persist($salle);

        }

        $manager->flush();
    }
}
