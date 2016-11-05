** Menu Dynamique **  
********************

La barre de menu contient: Prestataires | Services | Stages | Promos  
Au survol ces titres affiche x prestataires, categories de services, stages ou promos  
  
    
{{ render(controller('AppBundle:Default:menu',  { 'max': 5})) }}  
Dans la vue  _partials/_menu.html.twig tout commence par le render de menuAction qui se trouve dans le DefaultController.
(Cette action est dans le Controller par defaut car elle se rapporte à plusieures entités et pas une en particulier)  
  
**menuAction**  
Appelle plusieures fois la methode findNames qui est une méthode personnelle qui ne récumère que le slug et ne nom de l'entité pour les utilisér dans le menu dynamique.  
Une fois les variables $prestataires, $services, $stages, $promos obtenues je renvoie vers la vue *_partials/menu-dyn.html.twig*.  
La variable class sert à l'affichage ici sub-menu est ce qui convient pour coller au theme.

**_partials/menu-dyn.html.twig**   
est un simple ficher twig qui  rempli le menu avec les éléments recus en utilisant
- path() pour les liens 
- boucles pour remplir les ul

**Utilisation d'un service**  
La méthode findNames est placée dans un service pour éviter de placer quatre fois la même fonction dans quatre repositories.  






  

  
