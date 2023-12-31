<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [ 
        ['number' => '1', 'year' => '2009', 'description' => 'série avocat', 'program' => 'program_Murder'],
        ['number' => '2', 'year' => '2010', 'description' => 'série avocat', 'program' => 'program_Murder'],
        ['number' => '3', 'year' => '2011', 'description' => 'série avocat', 'program' => 'program_Murder'],
        ['number' => '4', 'year' => '2012', 'description' => 'série avocat', 'program' => 'program_Murder'],
    ];
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        // foreach(self::SEASONS as $seasonData) {
        //     $season = new Season();
        //     $season->setNumber($seasonData['number']);        
        //     $season->setYear($seasonData['year']);        
        //     $season->setDescription($seasonData['description']);        
        //     $season->setProgram($this->getReference($seasonData['program']));
        //     $manager->persist($season);

        //     $this->addReference('season' . $seasonData['number'] . '_' . $season->getProgram()->getTitle(), $season);
        // }

        for($i=0; $i < 5; $i++) {
            for($j = 0; $j < 5; $j++) {
                $season = new Season();
                $season->setNumber($j + 1);
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraphs(3, true));
    
                $season->setProgram($this->getReference('program_' . $i));
    
                $manager->persist($season);
    
                $this->addReference('program_' . $i . '_season_' . $j, $season);
            }
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
