## About Project
- Instalation avec docker:

    1- Crée un dossier dans lequel on va cloner les deux projets:
      # mkdir projects && cd projects

    2- Cloner le projet Symfony à partir du repository https://github.com/chedihayouni/eukles_api:
      
      # git clone https://github.com/chedihayouni/eukles_api

    3- Cloner le projet React JS à partir du repository https://github.com/chedihayouni/react_eukles:

      # git clone https://github.com/chedihayouni/react_eukles
    
    4- Copier le fichier docker.compose qui existe dans le projet Symfony et le coller au même niveau des deux projets dans le dossier créer dans la première étape.

    5- Lancer la commande pour créer les images:
    
      # docker-compose build

    6- Lancer la commande pour lancer le projet:
    
      # docker-compose up


    PS: Si vous rencontrez un problème il faut vérifier les droits sur les dossiers: logs, migrations ...

Liens:
 	- FrontEnd: http://localhost:3005
 	- BackEnd: http://localhost:8000
 	- phpmyadmin: http://localhost:8090

- Instalation sans docker:

  1- Cloner le projet Symfony à partir du repository https://github.com/chedihayouni/eukles_api:

      # git clone https://github.com/chedihayouni/eukles_api

  2- Lanser les commandes suivantes pour installer le projet Symfony:

      # composer install
  
  si symfony cli n'est pas installer: 
      # sudo apt install symfony-cli
  
      # symfony server:start
  
  Vérifier les accès pour le serveur bd dans le fichier .env
  
      # php bin/console doctrine:database:create
  
      # php bin/console doctrine:migrations:generate
  
      # php bin/console doctrine:migrations:migrate

  3- Cloner le projet React JS à partir du repository https://github.com/chedihayouni/react_eukles:

      # git clone https://github.com/chedihayouni/react_eukles

  4- Lanser les commandes suivantes pour installer le projet Symfony:

      # yarn install

      # yarn start

  Liens:
  - FrontEnd: http://localhost:3000
  - BackEnd: http://localhost:8000/
  - phpmyadmin: http://localhost/phpmyadmin/