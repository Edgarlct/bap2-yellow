<?php

namespace App\DataFixtures;

use App\Entity\SocialType;
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
         $user = new User();
         $user->setEmail('a@a.fr');
         $user->setRoles(['ROLE_ADMIN']);
         $user->setFirstName('a');
         $user->setLastName('a');
         $user->setAge('21');
         $user->setIsVerified(1);
         $user->setIsSub(true);
         $password = $this->hasher->hashPassword($user, 'a');

         $user->setPassword($password);
         $manager->persist($user);

         $socialType = [
             "tel",
             "email",
             "url",
         ];

        foreach ($socialType as $item) {
            $type = new SocialType();
            $type->setName($item);
            $manager->persist($type);
         }

         $manager->flush();
    }
}
