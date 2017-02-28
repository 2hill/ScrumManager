# ScrumManager

L'application permet de gérer la partie Scrum de l'entreprise. Créer des sprints, attribuer des heures, descendre des heures et afficher la burndownchat.

## Pour Commencer

Ces instructions vous permettront d'obtenir une copie du projet en cours d'exécution sur votre machine à des fins de développement et de test.

### Prérequis

Vous aurez besoin au préalable d'installer

* [WampServer](http://www.wampserver.com/) ou
* [Lamp] (https://doc.ubuntu-fr.org/lamp) ou
* [Mamp] (https://www.mamp.info/en/)

### Installation

__*Installation de Wamp*__

1. Télécharger wamp.
2. Installer wamp par son .exe
3. Une fois installé, lancer Wamp.
4. S'assurer que tous les services sont lancés. (l'icône doit être verte, ni orange, ni rouge)

__*Importation de l'application*__

1. Ouvrir le répertoire www de wamp. (Par défaut le répertoire ce situe à " C:\wamp64\www ")
2. Drag and drop le dossier ScrumManager dans le répertoire www.

__*Importation de la base de données*__

1. Lancer le service phpmyadmin de wamp. Disponible aussi en passant par " http://localhost/phpmyadmin/ "
 - Nom d'utilisateur : root
 - Mot de passe : "votre mot de passe"
2. Se diriger vers "importer"
3. Choisir le fichier "ToutEnUn.sql" et exécuter. La base de données s'est crée et remplie avec les données des sprints 96 - 97 - 98

__*Paramétrer les infos de l'application*__

1. Ouvrir le dossier ScrumManager
2. Editer le fichier header.php
3. Editer la ligne
  - $host = "localhost";
En remplacant "localhost" si vous avez édité vos configurations par défaut.
4. Editer la ligne
  - $conn = new mysqli('localhost', 'root', '', 'scrum')
  Si vous avez changé vos informations de connexion à la base de donnée et son nom.

__*Une fois tout installé, paramétré, il est temps de tester l'application*__

1. Démarrer wamp.
2. Lancer l'application. Par défaut elle sera accessible depuis un navigateur avec ce lien (http://localhost/ScrumManager/)

Vous voilà prêt à utiliser l'application.

## Choses à faire

Voici une liste de fonctionalités à ajouter dans l'application :

  - Permettre la **suppression** et **modification** de données:
    - Des sprints.
    - Des heures attribuées.
    - Des heures descendues.
  - Permettre l'actualisation des données affichées lorsque l'on sélectionne un sprint différent.
    - Pour les heures attribuées. (page2.php)
    - Pour les heures descendues. (page3.php)
  - Améliorer la connexion à la base de données depuis les différentes pages ?

## Développé avec

* [JMerise](http://www.jfreesoft.com/JMerise/) - Outil de modélisation des MCD
* [Bootstrap](http://getbootstrap.com/) - HTML, CSS, and JS framework
* [DataTables](https://datatables.net/) - Plug-in for the jQuery Javascript library

## Version

1.0

## Auteurs

* **Leriche Jérémy** - *Initial work* - [Jeje2201](https://github.com/Jeje2201)
* **Rahou Jamil** - *V1.1* - [2hill](https://github.com/2hill)

## License

     TBD
