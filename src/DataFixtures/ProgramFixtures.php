<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'title' => 'title 1',
            'synopsis' => 'synopsis 1',
            'poster' => 'poster 1',
            'category' => 'category_Action',
            'country' => 'FR',
            'year' => 2004,
        ],
        [
            'title' => 'title2',
            'synopsis' => 'synopsis 2',
            'poster' => 'poster 2',
            'category' => 'category_Horreur',
            'country' => 'FR',
            'year' => 2004,
        ],
        [
            'title' => 'title3',
            'synopsis' => 'synopsis 3',
            'poster' => 'poster 3',
            'category' => 'category_Aventure',
            'country' => 'FR',
            'year' => 2004,
        ],
        [
            'title' => 'title4',
            'synopsis' => 'synopsis 4',
            'poster' => 'poster 4',
            'category' => 'category_Fantastique',
            'country' => 'FR',
            'year' => 2004,
        ],
        [
            'title' => 'title5',
            'synopsis' => 'synopsis 5',
            'poster' => 'poster 5',
            'category' => 'category_Animation',
            'country' => 'FR',
            'year' => 2004,
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach(self::PROGRAMS as $programData) {
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setPoster($programData['poster']);
            $program->setCountry($programData['country']);
            $program->setYear($programData['year']);
            $program->setCategory($this->getReference($programData['category']));
            $manager->persist($program);
            $this->addReference('program_' . $programData['title'], $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }
}
