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


