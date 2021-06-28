<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1
            ->setEmail('crepe@yahoo.fr') // mdp = 'test'
            ->setRoles(["ROLE_TECH","ROLE_USER"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$FlyD1AgH1L421mt4dPUTkQ$YF4SvQRa0wg8ql0Pfs/FII/yYNAoD9+eLoJiIopa0h4')
            ->setFirstname('Georgette')
            ->setLastname('Crêpe');

        $metadata = $manager->getClassMetaData(get_class($user1));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $manager->persist($user1);

        $user2 = new User();
        $user2
            ->setEmail('newbie@googl.com') // mdp = 'test2'
            ->setRoles(["ROLE_USER"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$oPWzn9aM3UENuhCzpN5tBA$aUjx+7J38HKzYf9tpX4k2RVVuF92lIGSfQEuZZCe3ww')
            ->setFirstname('Newbie')
            ->setLastname('Newbieman');

        $metadata = $manager->getClassMetaData(get_class($user2));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $manager->persist($user2);

        $user3 = new User();
        $user3
            ->setEmail('admin@admin.fr') // mdp = 'admin'
            ->setRoles(["ROLE_ADMIN","ROLE_STRUCT", "ROLE_USER"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$kdaTpl47g6qSk7maaC43SQ$erzpRmm54765twRdDbahAsFU7bpG1wl5OKWRKFGFzn4')
            ->setFirstname('Jade')
            ->setLastname('Ministre');

        $metadata = $manager->getClassMetaData(get_class($user3));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $manager->persist($user3);

        $user4 = new User();
        $user4
            ->setEmail('pacome@hercial.fr') // mdp = 'struct'
            ->setRoles(["ROLE_STRUCT", "ROLE_USER"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$LXjkjPhhnl8jFmq8NKYZHQ$sgAGtYfKkevwWFYS2IURkglhN5gJB1clpMyijBMJDH4')
            ->setFirstname('Pacôme')
            ->setLastname('Hercial');

        $metadata = $manager->getClassMetaData(get_class($user4));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $manager->persist($user4);

        $user5 = new User();
        $user5
            ->setEmail('chaise@teck.ch') // mdp = 'tech'
            ->setRoles(["ROLE_ADMIN","ROLE_TECH", "ROLE_USER"])
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$IDEhKF6hMYd5wrRHZjV98w$4E8Fkg3vJMCPQgvsk3/3+15tLevHEljFgZzK0kr1AfE')
            ->setFirstname('Sylvestre')
            ->setLastname('Sanchez');

        $metadata = $manager->getClassMetaData(get_class($user5));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $manager->persist($user5);

        $manager->flush();

    }
}
