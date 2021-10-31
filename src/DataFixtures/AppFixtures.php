<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("user@bikeshop.com");
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($this->passwordEncoder->encodePassword($user,"user"));
        $manager->persist($user);

        $admin = new User();
        $admin->setEmail("admin@bikeshop.com");
        $admin->setRoles(["ROLE_ADMIN", "ROLE_USER"]);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin,"admin"));
        $manager->persist($user);

        $manager->flush();
    }
}