# skillsPortal
ecf PHP for CEFIM DWWM2020-2 // Todd Raharivelo


## Nota bene

Ce projet n'a pas rempli les exigences du cahier des charges de l'ECF. La raison en est que je n'ai pas réussi à finir dans le temps imparti.

## Documents additionnels

Dans le répertoire assets se trouvent deux fichiers :

- skillsPortal_BDD_V1.png
Il s'agit d'une capture d'écran du schéma de base de données que j'ai utilisé comme base du projet. Je l'ai modifié depuis suivant les suggestions de Doctrine. 

- data_tests.sql
Il s'agit d'un set de data qui permet de créer la base de données et de la remplir avec des données tests. 


## Outils

Ont été utilisés :
- PHPStorm en IDE, Symfony (avec Doctrine et Twig)
- Webpack Encore avec SASS pour le peu de styling présent
- easyAdmin pour l'interface administrateur


## Sur les rôles

Il a été considéré que dans cette application, les collaborateurs et les candidats ont le même statut : il s'agit de profils techniques qui ont accès uniquement à la création et à l'édition de leur profil, afin de rectifier et enrichir leur CV au fur et à mesure. 
La réelle différence entre ces deux rôles réside en le fait qu'un collaborateur peut être admin, là où un candidat ne le pourra jamais.


## Éclairage sur certains choix du schéma de base de données

- J'ai décidé de séparer les entités User et Profile, partant du principe que le portail était fait pour la gestion des compétences des profils techniques. Ainsi les utilisateurs de type structure n'auront pas de profil.
- J'ai choisi une relation de type ManyToMany pour la relation compétences-catégories, partant du principe que certaines compétences pouvaient se retrouver dans plusieurs catégories (on pourrait par exemple mettre "Python" dans "backend", "data", "langage"...)
- Concernant le lien compétences-profil (`skills_of_profile`), les champs "affinité" et "niveau" sont des nombres entiers car j'avais décidé de les représenter comme une échelle allant de 1 à 5, avec 1 la valeur la plus basse et 5 la valeur la plus haute. 
- Le champ "date de fin" de la table Expérience peut être null, car l'utilisateur ou son RH référent peut ajouter l'expérience tandis qu'elle est encore en cours. Il était prévu de considérer l'indicateur "si date de fin === null, alors le profil n'est pas disponible". 
- J'ai changé "isCandidate" en "isCollaborator" booléen, censé être faux par défaut. La confirmation qu'un profil créé est bien collaborateur doit passer par un admin.


## Concernant le data flow

Lorsqu'un utilisateur arrive sur l'application, s'il n'est pas déjà connecté, il est automatiquement redirigé vers la page de connexion. 
La page de connexion référence la page d'inscription et vice-versa.

Une fois connecté, l'utilisateur est redirigé selon son rôle :
- s'il a le rôle ROLE_STRUCT (structure), il sera redirigé vers la page "profiles" et pourra voir les profils enregistrés dans la base de données. 
- s'il a le rôle ROLE_TECH (technique), on regarde s'il a déjà un profil. 
Si l'utilisateur a déjà un profil, il sera redirigé vers la page de son profil.
Si l'utilisateur n'a pas de profil, il sera redirigé vers la page de création de profil. 
Il était prévu qu'un utilisateur de type technique ne puisse accéder qu'à son propre profil.

Lors de la création d'un profil, un utilisateur remplit intégralement le formulaire de profil : aucune information n'est récupéré depuis son pendant User.
Un profil nouvellement créé doit avoir le rôle candidat par défaut, ce qui revient à "isCollaborator = false = 0".

Les pages de lecture et d'édition de profil sont séparées.

Les utilisateurs ayant le rôle administrateur peuvent accéder à l'interface de gestion de l'administration (implémentée par easyAdmin) à l'adresse localhost:{port}/admin. Seuls les utilisateurs et les profils sont disponibles sur cette interface en l'état actuel du projet.

Il était prévu, comme établi dans le cahier des charges, que soient implémentés :
- la barre de recherche de profil (qui est présente seulement visuellement)
- l'affichage et la possibilité de création, édition et suppression des compétences, expériences et fichiers
- le reste des CRUD accessibles par un administrateur
