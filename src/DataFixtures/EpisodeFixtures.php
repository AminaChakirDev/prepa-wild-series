<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        ['title' => 'Pilot', 'number' => '1', 'synopsis' => 'Diagnosed with terminal lung cancer, chemistry teacher Walter White teams up with former student Jesse Pinkman to cook and sell crystal meth.', 'season' => 'season1_Murder'],
        ['title' => 'Cat\'s in the Bag...', 'number' => '2', 'synopsis' => 'After their first drug deal goes terribly wrong, Walt and Jesse are forced to deal with a corpse and a prisoner. Meanwhile, Skyler grows suspicious of Walt\'s activities', 'season' => 'season1_Murder'],
        ['title' => 'And the Bag\'s in the River', 'number' => '3', 'synopsis' => 'Walt and Jesse clean up after the bathtub incident before Walt decides what course of action to take with their prisoner Krazy-8.', 'season' => 'season1_Murder'],
        ['title' => 'Cancer Man', 'number' => '4', 'synopsis' => 'Walt tells the rest of his family about his cancer. Jesse tries to make amends with his own parents.', 'season' => 'season1_Murder'],
        ['title' => 'Seven Thirty-Seven', 'number' => '1', 'synopsis' => 'Walt and Jesse realize how dire their situation is. They must come up with a plan to kill Tuco before Tuco kills them first.', 'season' => 'season1_Murder']
    ];
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // foreach(self::EPISODES as $episodeData) {
        //     $episode = new Episode();

        //     $episode->setTitle($episodeData['title']);
        //     $episode->setNumber($episodeData['number']);
        //     $episode->setSynopsis($episodeData['synopsis']);
        //     $episode->setSeason($this->getReference($episodeData['season']));
            
        //     $manager->persist($episode);
        // }

        for($i=0; $i < 5; $i++) {
            for($j = 0; $j < 5; $j++) {
                for($k=0; $k < 10; $k++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->words(3, true));
                    $episode->setNumber($k + 1);
                    $episode->setSynopsis($faker->paragraphs(1, true));
        
                    $episode->setSeason($this->getReference('program_' . $i . '_season_' . $j));
        
                    $manager->persist($episode);
                }
            }
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
