<?php

namespace App\DataFixtures;

use App\Concert\Entity\Concert;
use Cake\Chronos\Chronos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $concerts[] = new Concert(
            'Flume',
            Chronos::now(),
            'Les vieilles Charues - Paris (75),France',
            49,
            'flume.jpg'
        );

        $concerts[] = new Concert(
            'Mura Masa',
            new Chronos('+3months'),
            'Les vieilles Charues - Paris (75),France',
            51,
            'mura_masa.jpg'
        );

        $concerts[] = new Concert(
            'Petit Biscuit',
            new Chronos('+5months'),
            'Les vieilles Charues - Paris (75),France',
            40,
            'petit_biscuit.jpg'
        );


        $concerts[] = new Concert(
            'Drake',
            Chronos::now(),
            'Les vieilles Charues - Paris (75),France',
            150,
            'drake.jpg'
        );

        $concerts[] = new Concert(
            'Cardi B',
            new Chronos('+3months'),
            'Les vieilles Charues - Paris (75),France',
            51,
            'cardiB.jpg'
        );

        $concerts[] = new Concert(
            'Travis Scott',
            new Chronos('+3months'),
            'Les vieilles Charues - Paris (75),France',
            51,
            'travis_scott.jpg'
        );

        $concerts[] = new Concert(
            'Rihanna',
            new Chronos('+5months'),
            'Les vieilles Charues - Paris (75),France',
            40,
            'rihanna.jpg'
        );

        foreach ($concerts as $concert) {
            $manager->persist($concert);
        }

        $manager->flush();
    }
}
