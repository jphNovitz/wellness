** Blocs **
-----------

J'utilise au maximum des petits bouts de code réustilisables.
Ces éléments se trouvent dans le répertoire **_partials/bloc/**

Le but est qu'il n'y ait pas ou peu de duplication de code.
Si un morceau de vue est réutilisable (y compris les boucles et l'adaptation des colonnes bootstrap) alors je le met dans ce répertoire.
Les futures vues seront plus rapidement construite.  
  
 
 Dans certains render(controller) je passe une variable *'view':'grid'*  
 J'utilise  *$page = (empty($view)) ? '_bloc-prestataires' : '_bloc-prestataires-grid';* dans le controller.  
 
 En fait je test simplement si je précise une vue à grid sinon la vue par défaut est une liste.
 
 Parfois des variables  sm, md, lg appraissent:   
 
 return $this->render('_partials/bloc/'.$page.'.html.twig',  
             ['prestataires' => $prestataires,  
                ** 'sm' => 12, **    
                ** 'md' => 3,  **   
                ** 'lg' => 3]  ** );  
                
  Il s'agit juste de passer des valeur au bloc pour qu'il adapte les largeurs de colonne pour le template.
  Au cas ou ces valeur ne seraient pas fournie j'ai prévu des valeurs par défaut.  
  
  ## to do ##
  chercher d'autres parties de code redondante et ajouter des blocs 
  
                
         