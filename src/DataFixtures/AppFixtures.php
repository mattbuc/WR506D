<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $actor = new Actor();
        $actor->setLastname('DOE');
        $actor->setFirstname('John');
        $actor->setDob(new \DateTime('1980-01-01'));
        $actor->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($actor);
        $manager->flush();
    }
}
