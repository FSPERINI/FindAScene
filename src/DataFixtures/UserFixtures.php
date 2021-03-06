<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserFixtures extends Fixture
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
       $user = new User();
       $user->setUsername('god');
       $user->setPassword($this->passwordEncoder->encodePassword($user,'god'));
       $user->setRoles(['ROLE_ADMIN']);
       $manager->persist($user);
       $manager->flush();
    }
}
