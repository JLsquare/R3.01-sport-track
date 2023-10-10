# Sport Track

Sport Track est une application web basée sur Express et Node.js qui a pour but de stocker et de visualiser les données recueillies lors d'activités sportives.

## Installation des dépendances
Assurez-vous d'avoir [Node.js](https://nodejs.org/en) et [npm](https://www.npmjs.com/) installés sur votre machine.

Pour installer les dépendances, exécutez :

```bash
npm install
```

/!\ sport_track_db doit être bien a coté dans le meme repertoire que sport_track_js

## Base de donnée

- Executer le script de création de table "create_table.sql" dans un fichier db.

```bash
sqlite3 ./db/sport_track.db < ./db/create_db.sql
```

- Pour tester la base de donnée, executer le script "test_db.sql", et le script "sport-track-db-test.js" :

```bash
sqlite3 ./db/sport_track.db < ./db/test_db.sql
```

```bash
node ./sport-track-db-test.js
```

## Deploiment

Pour lancer l'application:

```bash
npm start
```

Aller sur l'adresse suivante: http://localhost:3000/

## Fonctionnalités

Toutes les functionnalités ont été implementé et tester, avec des gestion d'erreurs. Ce qui comprend donc :

- Creation de compte (avec sécurités côté client et serveur)).

- Connection (avec des messages d'erreurs).

- Informations lors de la connection.

- Informations lors de la déconnection.

- Modification du compte (avec les memes sécurités que lors de la création de compte).

- Insertions des données avec des fichiers JSON (avec verification du format de fichier, et de l'integrité du fichier).

- Affichage des activités avec la description, la date, le temps de debut, la durée, la distance, et les fréquences cardiaque.

- Affichage des entrées des activités.

- Suppression des activités, et des entrées d'activités.

## Code

Le code de sport_track_js et sport_track_db est commenté, et les fonctions sont nommées de manière explicite.

## Autheurs

- HASCOET Anthony

- MELLION Jean-Loup
