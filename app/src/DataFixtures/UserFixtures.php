<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct( UserPasswordHasherInterface $hasher){
        $this->passwordEncoder = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setPrenom('hanakhin');
        $user->setNom('Nouni-masotte');
        $user->setEmail('hanakhin@gmail.com');
        $user->setPassword($this->passwordEncoder->hashPassword($user, 'hanakhin'));
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN','ROLE_TECH']);
        $user->setActive(true);
        $manager->persist($user);
        $manager->flush();
    }
}
