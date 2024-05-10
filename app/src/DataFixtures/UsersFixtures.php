<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher){}

    public function load(ObjectManager $manager): void
    {
        $newUser = new Users();

        $newUser->setNickname('User');
        $newUser->setPassword($this->hasher->hashPassword($newUser, 'azerty'));
        $newUser->setEmail('user@demo.fr');
        $newUser->setIsVerified(true);

        $manager->persist($newUser);

        $newUser = new Users();

        $newUser->setNickname('Admin');
        $newUser->setPassword($this->hasher->hashPassword($newUser, 'azerty'));
        $newUser->setEmail('admin@demo.fr');
        $newUser->setIsVerified(true);
        $newUser->setRoles(['ROLE_ADMIN']);
        $this->setReference('Admin', $newUser);

        $manager->persist($newUser);

        $manager->flush();
    }
}
