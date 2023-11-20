<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;
use App\Entity\Movie;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));

        $actors = $faker->actors($gender = null, $count = 100, $duplicates = false);
        foreach ($actors as $item){

            $fullname = $item; // Christian BALE
            $fullnameExploded = explode(' ', $fullname); // ['Christian', 'BALE']

            $firstname = $fullnameExploded[0]; // 'Christian'
            $lastname = $fullnameExploded[1]; // 'BALE'

            $actors = new Actor();
            $actors->setFirstname($firstname);
            $actors->setLastname($lastname);
            $actors->setDob(new \DateTime());
            $actors->setCreatedAt(new \DateTimeImmutable());

            $createdActors[] = $actors;

            $manager->persist($actors);

        }

        $movies = $faker->movies(10);
        foreach ($movies as $item){

            $movies = new Movie();
            $movies->setTitle($item);

            shuffle($createdActors);
            $createdActorsSliced = array_slice($createdActors, 0, 4);
            foreach ($createdActorsSliced as $actor){
                $movies->addActor($actor);
            }

            $manager->persist($movies);

        }


        $manager->flush();

        /*$actor = new Actor();
        $actor->setLastname('LEBRON');
        $actor->setFirstname('James');
        $actor->setDob(new \DateTime('1992-07-09'));
        $actor->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($actor);
        $manager->flush();*/
    }
}
