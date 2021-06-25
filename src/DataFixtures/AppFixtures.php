<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Users
        $user = new User();
        $user->setEmail('crepe@yahoo.fr');
        $user->setRoles(['ROLE_TECH','ROLE_USER']);
        // 'test'
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$FlyD1AgH1L421mt4dPUTkQ$YF4SvQRa0wg8ql0Pfs/FII/yYNAoD9+eLoJiIopa0h4');
        $user->setFirstname('Georgette');
        $user->setLastname('Crêpe');

        $manager->persist($user);
        $manager->flush();

        // TODO : les users connus
        // Profiles


        // Companies


        // Experiences


        // Categories

        // Skills

    }
}
