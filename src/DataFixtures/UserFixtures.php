<?php

namespace App\DataFixtures;

use App\Concert\Entity\Concert;
use App\User\Entity\User;
use Cake\Chronos\Chronos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $users[] = new User(
            'Sylvie',
            'Godard',
            '25', 'female', 'sylvie@sylvie.com',
            1, 'sylvie.jpg', 'test'
        );

        $users[] = new User(
            'Xavier',
            'Godard',
            '26', 'female', 'xavier@xavier.com',
            0, 'xavier.jpg', 'test3'
        );

        $users[] = new User(
            'Christelle',
            'Yamga',
            '25', 'female', 'chri@chri.com',
            0, 'christelle.jpg', 'test2'
        );

        $users[] = new User(
            'Shirley',
            'pottier',
            '25', 'female', 'shirley@shirley.com',
            0, 'shirley.jpg', 'test1'
        );

        foreach ($users as $user) {
            $manager->persist($user);
        }

        $manager->flush();
    }
}