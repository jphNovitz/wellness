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
  
Utilisation de Hautelook/aliceBundle qui s'appuie sur Faker de FZaninotto.


