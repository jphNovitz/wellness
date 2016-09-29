isl_wellness
============

Projet Annuaire Wellness  September 29, 2016, 7:20 pm.

Création des entité Utilisateur, Prestataires et Internaute
===========================================================
  
 Utilisation de Single Table Inheritance
 ---------------------------------------
  
* Créer une entité Utilisateur qui contient ce qui sera commun aux entités Prestataire et internaute.
* Créer les entités Prestataire et Internaute en ajoutant "extends Utilisateur"  
* Modification de l'annotation de l'entité Utilisateur
  * @ORM\InheritanceType("SINGLE_TABLE")
  * @ORM\DiscriminatorColumn(name="type", type="string")
  * @ORM\DiscriminatorMap({"Utilisateur" = "Utilisateur", "prestataire" = "Prestataire", "internaute" = "Internaute"})
* Pas de champs 'type' c'est doctrine qui s'en occuppe
* Les champs des Entités filles doivent être mis à Nullable=true  
  
Pour vérifier le bon fonctionnement j'ai installer les Bundle DoctrineFixture et Faker. Pour injecter facilement des jeux de fausses données dans ma BD
* composer require --dev doctrine/doctrine-fixtures-bundle 
* composer require --dev fzaninotto/faker
* <http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/inheritance-mapping.html>


