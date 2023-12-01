<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        [
            'title' => 'Titre episode 1',
            'number' => 1,
            'synopsis' => 'Ceci est le synopsis de l\'épisode 1',
            'season' => 'season1_title 1',
        ],
        [
            'title' => 'Titre episode 2',
            'number' => 2,
            'synopsis' => 'Ceci est le synopsis de l\'épisode 2',
            'season' => 'season1_title 1',
        ],
        [
            'title' => 'Titre episode 3',
            'number' => 3,
            'synopsis' => 'Ceci est le synopsis de l\'épisode 3',
            'season' => 'season1_title 1',
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach(self::EPISODES as $episodeData) {
            $episode = new Episode();
            $episode->setNumber($episodeData['number']);
            $episode->setTitle($episodeData['title']);
            $episode->setSynopsis($episodeData['synopsis']);
            $episode->setSeason($this->getReference($episodeData['season']));
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          SeasonFixtures::class,
        ];
    }
}
