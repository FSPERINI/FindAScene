<?php

namespace App\DataFixtures;

use App\Entity\Musiciens;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class MusiciensFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;    
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i =0; $i < 100; $i++){
            $musiciens = new Musiciens();
            $musiciens
            ->setName($faker->firstName())    
            ->setPassword($this->passwordEncoder->encodePassword($musiciens,'demo'))
            ->setGroupe($faker->lastName)
            ->setMail($faker->freeEmail)
            ->setCity($faker->city)
            ->setSlug($faker->word)
            ->setRoles(['ROLE_MUSICIENS'])
            ->setDescription($faker->sentences( 10 , true))
            ;
            $manager->persist($musiciens);

        }

        $manager->flush();
    }
}
