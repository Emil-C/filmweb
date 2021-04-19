<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Movie;
use DateTime;
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
        $user->setBirthDate(new DateTime('05-05-1995'));
        $user->setLocale('en');
        $user->setLogin('emil.n');
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
        $user1->setBirthDate(new DateTime('17-02-1982'));
        $user1->setLocale('pl');
        $user1->setLogin('janek');
        $user1->setRoles(['ROLE_USER']);
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'test123'
        ));
        $manager->persist($user1);
        
        $movie = new Movie();
        $movie->setTitle('Titanic');
        $movie->setDescription('Lorem ipsum, lorem ipsum.');
        $movie->setPremiere(new DateTime());
        $movie->setDuration(123);
        $manager->persist($movie);

        $comment1 = new Comment();
        $comment1->setText('comment comment comment 1');
        $comment1->setCreatedAt();
        $comment1->setAuthor($user);
        $comment1->setMovie($movie);
        $manager->persist($comment1);

        $manager->flush();
    }
}
