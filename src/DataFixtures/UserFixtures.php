<?php

namespace App\DataFixtures;

use App\User\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User(
            'Sylvie',
            'Godard',
            '25', 'female', 'sylvie@sylvie.com',
            1,  null, 'sylvie.jpg'
        );
        $user1->setPassword($this->encodePassword($user1, 'test'));
        $users[] = $user1;

        $user2 = new User(
            'Xavier',
            'Godard',
            '26', 'female', 'xavier@xavier.com',
            0,null, 'xavier.jpg'
        );
        $user2->setPassword($this->encodePassword($user2, 'test2'));
        $users[] = $user2;

        $user3 = new User(
            'Christelle',
            'Yamga',
            '25', 'female', 'chri@chri.com',
            0, null, 'christelle.jpg'
        );
        $user3->setPassword($this->encodePassword($user3, 'test3'));
        $users[] = $user3;

        $user4 = new User(
            'Shirley',
            'pottier',
            '25', 'female', 'shirley@shirley.com',
            0, null, 'shirley.jpg'
        );
        $user4->setPassword($this->encodePassword($user4, 'test4'));
        $users[] = $user4;

        foreach ($users as $user) {
            $manager->persist($user);
        }

        $manager->flush();
    }

    private function encodePassword(User $user, string $password): string
    {
        return $this->passwordEncoder->encodePassword($user, $password);
    }
}
