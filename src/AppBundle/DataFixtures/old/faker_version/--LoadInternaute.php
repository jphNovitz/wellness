<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Internaute;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Faker;

use AppBundle\Entity\Utilisateur;

class LoadInternauteData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i<10; $i++) {

        $internaute[$i] = new Internaute();

        $internaute[$i]->setAddresseRue($faker->streetName);
        $internaute[$i]->setAddresseNum(rand(1, 100));
        $internaute[$i]->setBanni('n');
        $internaute[$i]->setConfrimation('n');

        // $prestataire->getDateInscription(new \DateTime());
        $internaute[$i]->setNom($faker->name);
        $internaute[$i]->setEssais(3);
        $internaute[$i]->setPassword($faker->password);
        $internaute[$i]->setEmail($faker->email);

        $manager->persist($internaute[$i]);
    }
        $manager->flush();

    }
}