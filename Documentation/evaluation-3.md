Changements

**20-12-2016**  
Correction du menu, il manquait juste le path() dans le href.

**22-12-2016**  
- Les methodes concernant la recherche d'un prestataire ont été déplacées vers un controller, ce controller se trouve dans le 
répertoire Prestataire car la recherche est principalement une recherche de prestataire.  
- security.yml : seul le répertoire profile est protégé, c'est le même répertoire pour les prestataires et les internaute.
Le'utilisateur ne verra que sont profil derriere /profile/  

**23-12-2016**  
Réécriture de la methode findLastN()  
- Je suis passé de 18 à 11 requetes sur la page, le renderController de l'affichage de cette requête ne compte 
que 1 seule requête.  
- j'ai pu utiliser  return $qb->getQuery()->execute(); au lieu de return new paginator($qb);  
- La modification de la requête m'a forcé à modifier des détails de la vue twig (_bloc-prestataire-grid) vers une écriture plus simple  
- Mission accomplie pour cette partie.  
- réécriture de la requête pour le slider -> correction du fichier slider twig.  
- Il reste 7 requêtes:  
-- 1 pour l'affichage des derniers prestataires  
-- 1 pour la liste des services  
-- 5 pour l'affichage du meny dynamique, une reqête par prestataire.  C'est là que je peux gagner qqchose à condition de passer à un menu statique.  

**25-12-2016**  
Réécriture de la méhode myFind All
- je ne consomme qu'une seule requête et je ne n'ai pas eu à modifier le template twig.
- **Si je fais un dump() de ma variable je vois des variables telles que password, est-il possible que qqun accède à ces variables
**   

**26-12-2016**  
Pagination dans la liste des prestataires
- modifications controller - repository - vue twig -> la pagination est dans un bloc '_partials'  
- ajouté un count sur les prestataires  
-  Tous les éléments de pagination sont envoyé avec la réponse dans un tableau $pagination.  
- l'aspect de la pagination est exactement comme le modèle.  
  
**28-12-2016**  
- Fin de modification de findAll -> myFindAll pour les services, stages et promos (de 21 à 5 requettes) -> requêtes pour le menu  
- Correction menu "trouver un prestataire"  
--  ajout d'une route (path) dans le href du menu  
-- creation de la page d'affichage du formulaire de recherche, la page et le formulaire existaient déjà mais brut sans respecter
la charte graphique du site.  

**29-12-2016**  
- Creation d'une vue simple pour la page promo_detail.  Vue ultra simple !  

**30-12-2016**  
- Modification de la confirmation d'inscription:  
-- Le formulaire de confirmation est un formulaire plus ou moins complet 
-- la partie url et description du logo est un peu sale car manyToOne à persister en deux fois
-- To do:  
--- améliorer la partie 'ajout logo' du formulaire
--- verifier que tous les champs soient requis pour valider  

**01/01/2017**  
- régroupé fichiers md dans le répertoire /Documentation
- refactor et commentaires de verificationAction (SecurityController)  
- la methode minimumToPersist est remplacée par prestatairePersist qui est chargée de faire les deux persist 
(un pour l'utilisateur et un pour le logo)
TODO
persistInternaute
integrer champs logo dans le design du formulaire
empecher champs nullable dans le formulaire de confirmation
mettre des petits test pour detecter probleme dans exécution

