<?php

namespace App\DataFixtures;

use App\Entity\Keywords;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class KeywordsFixtures extends Fixture
{
    public function __construct(private readonly SluggerInterface $slugger){}

    public function load(ObjectManager $manager):void
    {
        $keywords = [
            'France', 'Politique', 'Monde', 'Informatique', 'Economie', 'Associations'
        ];

        foreach($keywords as $keyword){   
            $newKeyword = new Keywords();
            $newKeyword->setName($keyword);

            $slug = strtolower($this->slugger->slug($newKeyword->getName()));

            $newKeyword->setSlug($slug);
            
            $manager->persist($newKeyword);
        }

        $manager->flush();
    }
}