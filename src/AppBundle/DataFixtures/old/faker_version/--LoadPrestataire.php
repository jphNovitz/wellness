<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Prestataire;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Faker;

use AppBundle\Entity\Utilisateur;

class LoadPrestataireData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i<5; $i++) {

        $prestataire[$i] = new Prestataire();

        $prestataire[$i]->setAddresseRue($faker->streetName);
        $prestataire[$i]->setAddresseNum(rand(1, 100));
        $prestataire[$i]->setBanni('n');
        $prestataire[$i]->setConfrimation('n');

        // $prestataire->getDateInscription(new \DateTime());
        $prestataire[$i]->setNom($faker->company);
        $prestataire[$i]->setEssais(3);
        $prestataire[$i]->setPassword($faker->password);
        $prestataire[$i]->setSiteWeb($faker->url);
        $prestataire[$i]->setTel($faker->phoneNumber);
        $prestataire[$i]->setTva($faker->swiftBicNumber);
        $prestataire[$i]->setEmail($faker->companyEmail);


        $manager->persist($prestataire[$i]);
    }
        $manager->flush();

    }
}