<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Movie;
use App\Entity\User;
use App\Entity\WatchHistory;
use App\Entity\Serie;
use App\Entity\Playlist;
use App\Entity\Season;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create multiple movies
        for ($i = 0; $i < 50; $i++) {
            $film = new Movie();
            $film->setTitle('Film ' . $i);
            $film->setCoverImage('image' . $i . '.png');
            $film->setShortDescription('Short description ' . $i);
            $film->setLongDescription('Long description ' . $i);
            $film->setReleaseDate(new \DateTime());
            $manager->persist($film);
        }

        // Modify details of Avatar and add more movies
        $film2 = new Movie();
        $film2->setTitle('Avatar 2');
        $film2->setCoverImage('avatar2.png');
        $film2->setShortDescription('Sequel to Avatar with more blue eco-warriors.');
        $film2->setLongDescription('The second installment of Avatar, with even more stunning visuals and environmental themes.');
        $film2->setReleaseDate(new \DateTime('+1 day'));
        $manager->persist($film2);

        $film3 = new Movie();
        $film3->setTitle('Inception');
        $film3->setCoverImage('inception.png');
        $film3->setShortDescription('A mind-bending thriller about dreams within dreams.');
        $film3->setLongDescription('A skilled thief who enters the subconscious of others to steal their secrets faces his most challenging mission yet.');
        $film3->setReleaseDate(new \DateTime('-5 years'));
        $manager->persist($film3);

        // Add more users
        $user1 = new User();
        $user1->setUsername('john_doe');
        $user1->setEmail('john@example.com');
        $user1->setPassword('password123');
        $user1->setAccountStatus(UserAccountStatusEnum::ACTIVE);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('jane_doe');
        $user2->setEmail('jane@example.com');
        $user2->setPassword('securepassword');
        $user2->setAccountStatus(UserAccountStatusEnum::INACTIVE);
        $manager->persist($user2);

        // Add more watch histories
        $history1 = new WatchHistory();
        $history1->setMedia($film2);
        $history1->setWatcher($user1);
        $history1->setLastWatchedAt(new \DateTimeImmutable());
        $history1->setNumberOfViews(3);
        $manager->persist($history1);

        $history2 = new WatchHistory();
        $history2->setMedia($film3);
        $history2->setWatcher($user2);
        $history2->setLastWatchedAt(new \DateTimeImmutable());
        $history2->setNumberOfViews(7);
        $manager->persist($history2);

        // Add more categories
        $categories = [
            ['Comedy', 'comedy'],
            ['Drama', 'drama'],
            ['Science Fiction', 'sci-fi'],
            ['Documentary', 'documentary']
        ];

        foreach ($categories as $element) {
            $category = new Category();
            $category->setLabel($element[1]);
            $category->setNom($element[0]);
            $manager->persist($category);
        }

        // Add series with seasons
        $serie1 = new Serie();
        $serie1->setTitle('Breaking Bad');
        $serie1->setCoverImage('breakingbad.png');
        $serie1->setShortDescription('A high school chemistry teacher turned methamphetamine producer.');
        $serie1->setLongDescription('The story of Walter White, a chemistry teacher who starts producing meth to secure his family\'s future.');
        $serie1->setReleaseDate(new \DateTime('-10 years'));
        $manager->persist($serie1);

        // Add seasons to the series
        for ($i = 1; $i <= 5; $i++) {
            $season = new Season();
            $season->setNumber($i);
            $season->setSerie($serie1);
            $manager->persist($season);
        }

        $serie2 = new Serie();
        $serie2->setTitle('Game of Thrones');
        $serie2->setCoverImage('got.png');
        $serie2->setShortDescription('Seven kingdoms fighting for the Iron Throne.');
        $serie2->setLongDescription('A medieval fantasy epic where noble houses vie for control of the Iron Throne.');
        $serie2->setReleaseDate(new \DateTime('-12 years'));
        $manager->persist($serie2);

        // Add seasons to the second series
        for ($i = 1; $i <= 8; $i++) {
            $season = new Season();
            $season->setNumber($i);
            $season->setSerie($serie2);
            $manager->persist($season);
        }

        // Add playlists
        $playlist1 = new Playlist();
        $playlist1->setName('John\'s Favorite Movies');
        $playlist1->setCreatedAt(new \DateTimeImmutable());
        $playlist1->setUpdatedAt(new \DateTimeImmutable());
        $playlist1->setCreator($user1);
        $manager->persist($playlist1);

        $playlist2 = new Playlist();
        $playlist2->setName('Jane\'s TV Shows');
        $playlist2->setCreatedAt(new \DateTimeImmutable());
        $playlist2->setUpdatedAt(new \DateTimeImmutable());
        $playlist2->setCreator($user2);
        $manager->persist($playlist2);

        $manager->flush();
    }
}