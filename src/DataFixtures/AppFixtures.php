<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $users= [
            ['username'=>"YAM-KING","role"=>['ROLE_ADMIN']],
            ['username'=>"IBRAHIM","role"=>['ROLE_ADMIN']],
            ['username'=>"ADMIN","role"=>['ROLE_ADMIN']]
        ];
        foreach ($users as $u) {
            $user = new User();
            $user->setUsername($u['username']);
            $user->setRoles($u['role']);
            $user->setPassword('$2y$13$/hSL/WeOoOAKAFj.4hKV2.nKHspyr3FhFVxc2lomE6sbWfz4wY6ne');
            $user->setAvatar('default.png');
            $manager->persist($user);
        }

        $manager->flush();
    }
}
