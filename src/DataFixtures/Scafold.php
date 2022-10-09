<?php

namespace App\DataFixtures;

use App\Entity\Cite;
use App\Entity\Commune;
use App\Entity\Daira;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Scafold extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $daira=['Ngaoundéré'];
        $communes = ['Ngaoundéré 1', 'Ngaoundéré 2', 'Ngaoundéré 3'];
        $cities = ["Future dirigeant", 'Halima', 'Karna manga', 'Casa de papel', 'Espoir 1', 'Bazor'];

        $daira = new Daira();
        $daira->setNom('Ngaoundéré');
        $manager->persist($daira);
        foreach ($communes as $name) {
            $commune = new Commune();
            $commune->setDaira($daira);
            $commune->setNom($name);
            $manager->persist($commune);
            if ($name == 'Ngaoundéré 3') {
                foreach ($cities as $c) {

                    $city = new Cite();
                    $city->setCommune($commune);
                    $city->setNom($c);
                    $manager->persist($city);
                }
            }
            # code...
        }

        $manager->flush();
    }
}
