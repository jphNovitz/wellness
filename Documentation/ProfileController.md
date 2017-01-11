Profile Controller
==================
  
profile_detail
--------------

Lors de l'inscription j'ai assigné deux Roles à mon utilisateur:
* ROLE_USER: dans tous les cas 
* ROLE_PRESTATAIRE: s'il s'agit d'un prestataire
* ROLE_INTERNAUTE: s'il s'agit dun internaute.  

Ma configuration security.yml empêche l'accès à ce dossier si l'utilisateur n'a pas au moins le ROLE_USER
Je teste s'il sagit l'utilisateur est un prestataire ou un internaute.
Je récupère les informations qu'il me manque et je renvoie vers la vue correspondante

La méthode getClassName($user)
 * retourne s'il s'agit d'un Prestataire ou d'un Internaute.
 * la méthode se trouve dans un service (app.verify_profile)  
 
_Je fais une requete pour recupérer les Stages, les Promos, les commentaires.  Peut-être pas de possibilité de faire 
autrement avec les relations telles qu'elles sont maintenant car les utilisateur n'ont pas conscience des promos et stages._  
  
profile_update
--------------

la route est __profile/update__ et non _update/profile_ pour garder la __protection__ du répertoire profile.
Le composant de sécurité empêche d'accéder à ce controller si on est pas connecrté.  

J'utilise le _service_ 'app.verify_profile' pour récupérer l'utilisateur. 
La méthode __getUser__ retourne false si l'utilisateur n'est pas un objet.
Si la getUser a retourné false alors je renvoie vers la page 'login'

Dans un switch, je crée le formulaire Presataire ou le formulaire Internaute. 
Si aucun formulaire n'a été soumis je renvoie vers la vue.
Si un formulaire a été soumis et s'il est valide.
* je teste si on a cliqué sur _'delete'_ alors je renvoie vers le deleteAction
* je persist l'utilisateur.

Pour les opération de persist/flush j'utilise la methode persist() de mon service PersistOrRemove.
Mon objectif est d'alléger le controller et d'éviter la duplcation de code.  

profile_delete
--------------

Le principe est que dans la page update il y a un bouton 'supprimer mon profil'  
Ce bouton renvoie vers une page de confirmation qui contient un simple formulaire qui ne contient qu'un seul bouton submit.  
Ce bouton de confirmation n'efface pas l'utilisateur.   
l'Entité Utilisateur contient un flag Actif (booleen) qui est mis à false lors de la suppression.
Je ne supprime pas réellement l'utilisateur de la base de donnée je les mets en 'inactif'.  
Le but est de pouvoir revenir en arrière.

