<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFName('Emil');
        $user->setLName('Nowak');
        $user->setEmail('emil@op.pl');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'test123'
        ));

        $manager->persist($user);
        $user1 = new User();
        $user1->setFName('Janusz');
        $user1->setLName('Kowalski');
        $user1->setEmail('j.kowalski@op.pl');
        $user1->setRoles(['ROLE_USER']);
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'test123'
        ));

        $manager->persist($user1);
        $manager->flush();
    }
}
