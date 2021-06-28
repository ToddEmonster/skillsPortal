<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $profile1 = new Profile();
        $profile1
            ->setFirstName('Georgette')
            ->setLastName('Crêpe')
            ->setJobTitle('Développeuse web')
            ->setEmail('crepe@yahoo.fr')
            ->setTel('0123456789')
            ->setCreationDate(new \DateTime())
            ->setLastEditDate(new \DateTime())
            ->setUser($manager
                          ->getRepository(User::class)
                            ->findBy(['email'=>'crepe@yahoo.fr']));
        $metadata = $manager->getClassMetaData(get_class($profile1));
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $manager->persist($profile1);

        $manager->flush();
    }
}
