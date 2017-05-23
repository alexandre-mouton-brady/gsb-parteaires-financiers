# GSB - Applications partenaires #

Code source du projet visant à la création d'une application pour les collaborateurs de l'entreprise GSB. La plateforme permet de s'inscrire, se connecter, et effectuer des dons.

# Structure #

Explication de la structure des dossiers

## Routes ##

Chaque controlleur à son dossier avec un unique fichier appelé "index.php" ce qui permet de générer de belles urls.

Ainsi nous avons quatre types de routes possibles : 

* ./index.php => Accueil
* ./connexion/index.php => Connexion
* ./inscription/index.php => Inscription
* ./top-utilisateur/index.php => Affichage des statistiques
* ./erreur/index.php => Page d'erreur affiché lorsque l'utilisateur se trompe 3 fois

Chaque controlleur est responsable d'afficher une vue spéfique en fonction de certains paramètres tels que :

* La méthode par laquelle il a été appelé : POST ou GET
* Si l'utilisateur est connecté ou non

## Vues ##

Le dossier views comprend toutes les vues possible de l'application. Il a été séparé en trois groupes :

* ./views/components : Composants modulaire de l'application (peu travaillé)
* ./views/pages : Les différentes pages à affichées
* ./views/templates : Les éléments qui se repètes (header, footer, etc.)

## Classes ##

Le dosser ./classes l'ensemble des classes faisant tourner l'application.

* ./classes/class.BDD.inc.php : Sert de modèle pour les controlleur. Responsable de tous les appels à la BDD
* ./classes/class.Partenaire.inc.php : Sert à instancier le partenaire lors de la connexion

## Styles, scripts et images ##

Le dossier ./assets comprends l'ensemble des images et feuilles de styles


### Auteur ###

Alexandre Mouton-Brady