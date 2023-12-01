<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        [
            'number' => 1,
            'year' => 2002,
            'description' => 'description saison 1',
            'program' => 'program_title 1'
        ],
        [
            'number' => 2,
            'year' => 2003,
            'description' => 'description saison 2',
            'program' => 'program_title 1'
        ],
        [
            'number' => 3,
            'year' => 2004,
            'description' => 'description saison 3',
            'program' => 'program_title 1'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::SEASONS as $seasonData) {
            $season = new Season();
            $season->setNumber($seasonData['number']);
            $season->setYear($seasonData['year']);
            $season->setDescription($seasonData['description']);
            $season->setProgram($this->getReference($seasonData['program']));
            $manager->persist($season);
            $this->addReference('season' . $seasonData['number'] . '_' . $season->getProgram()->getTitle(), $season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ProgramFixtures::class,
        ];
    }
}
