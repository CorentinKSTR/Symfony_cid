<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
            $user = new User();
            $user->setEmail('user'.$i.'@gmail.com');
            $user->setRoles(['ROLE_ADMIN']);
            $password = $this->hasher->hashPassword($user, 'testing');
            $user->setPassword($password);
            $user->setIsVerified(true);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
