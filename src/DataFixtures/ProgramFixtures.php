<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture
{
    public const PROGRAMS = [
        ['title'=>'Murder', 'synopsis'=>'Annalise Keating, brillante avocate et professeur de droit, se retrouve impliquée dans une affaire de meurtre avec cinq de ses étudiants.', 'category'=>'category_Action',],
        ['title'=>'Vikings', 'synopsis'=>'Scandinavie, à la fin du 8ème siècle. Ragnar Lodbrok, un jeune guerrier viking, est avide d\'aventures et de nouvelles conquêtes. Lassé des pillages sur les terres de l\'Est, il se met en tête d\'explorer l\'Ouest par la mer.', 'category'=>'category_Action',],
        ['title'=>'Breaking Bad', 'synopsis'=>'Walter White, 50 ans, est professeur de chimie dans un lycée du Nouveau-Mexique. Pour réunir de l\'argent afin de subvenir aux besoins de sa famille, Walter met ses connaissances en chimie à profit pour fabriquer et vendre du crystal meth.', 'category'=>'category_Action',],
        ['title'=>'Stranger Things', 'synopsis'=>'En 1983, à Hawkins dans l\'Indiana, Will Byers disparaît de son domicile. Ses amis se lancent alors dans une recherche semée d\'embûches pour le retrouver. Pendant leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite.', 'category'=>'category_Aventure',],
        ['title'=>'The Witcher', 'synopsis'=>'Le sorceleur Geralt, un chasseur de monstres, se bat pour trouver sa place dans un monde où les humains se révèlent plus vicieux que les bêtes. Il est alors happé dans une mystérieuse toile tissée par les forces luttant pour contrôler le monde', 'category'=>'category_Aventure',],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach(self::PROGRAMS as $key => $programData) {
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setCategory($this->getReference($programData['category']));

            $manager->persist($program);

            //$this->addReference('program_' . $programData['title'], $program);
            $this->addReference('program_' . $key, $program);
        }

        $manager->flush();
    }
}
