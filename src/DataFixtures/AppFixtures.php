<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;
use App\Entity\Movie;
use App\Entity\Category;
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

            $reward = ['Oscar', 'César', 'Palme d\'or'];
            $nationality = ['Français', 'Américain', 'Anglais', 'Allemand', 'Espagnol'];

            $actors = new Actor();
            $actors->setFirstname($firstname);
            $actors->setLastname($lastname);
            $actors->setDob($faker->dateTimeThisCentury());
            $actors->setCreatedAt(new \DateTimeImmutable());
            // Sélectionnez une nationalité de manière aléatoire
            $randomNationality = $nationality[array_rand($nationality)];

            $actors->setNationality($randomNationality);

            // Générer un nombre aléatoire de récompenses (de 0 à 3)
            $numberOfRewards = mt_rand(1, min(3, count($reward)));

            // Sélectionnez des clés aléatoires du tableau $reward
            $randomRewardKeys = array_rand($reward, $numberOfRewards);

            // Si une seule récompense, assurez-vous qu'il est dans un tableau
            $randomRewards = is_array($randomRewardKeys) ? array_intersect_key($reward, array_flip($randomRewardKeys)) : [$reward[$randomRewardKeys]];
            foreach ($randomRewards as $randomReward) {
                $actors->setReward($randomReward);
            }

            $createdActors[] = $actors;

            $manager->persist($actors);

        }

        $movies = $faker->movies(10);
        foreach ($movies as $item){

            $movies = new Movie();
            $movies->setTitle($item);
            $movies->setReleaseDate($faker->dateTimeThisCentury());
            $movies->setDescription($faker->text($maxNbChars = 200));
            $movies->setDuration($faker->numberBetween($min = 60, $max = 180));
            $movies->setNote(
                $faker->randomFloat(
                    $nbMaxDecimals = 1,
                    $min = 0,
                    $max = 10
                )
            );
            $movies->setEntries($faker->numberBetween($min = 10000, $max = 10000000));
            $movies->setBudget($faker->numberBetween($min = 100000, $max = 1000000));
            $movies->setDirector($faker->director());
            $movies->setWebsite($faker->imageUrl(360, 360, 'animals', true, 'dogs', true, 'jpg'));
            shuffle($createdActors);
            $createdActorsSliced = array_slice($createdActors, 0, 4);
            foreach ($createdActorsSliced as $actor){
                $movies->addActor($actor);
            }

            $createdMovies[] = $movies;

            $manager->persist($movies);

        }

        $categories = ['Action', 'Comédie', 'Drame', 'Horreur', 'Science-fiction'];
        foreach ($categories as $item){
            $category = new Category();
            $category->setName($item);

            shuffle($createdMovies);
            $createdMoviesSliced = array_slice($createdMovies, 0, 4);
            foreach ($createdMoviesSliced as $movie){
                $category->addMovies($movie);
            }

            $manager->persist($category);
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
