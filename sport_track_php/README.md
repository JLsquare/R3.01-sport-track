# Sport Track

Sport Track est une application web ecrite en php qui a pour but de stocker et de visualiser les données recolté lors d'activité sportives.

## Installation des dépendances

### Pour Ubuntu :

```bash
sudo apt install php php-sqlite3
```

### Pour Fedora :

```bash
sudo dnf install php php-sqlite3
```

### Pour Arch :

```bash
sudo pacman -S php php-sqlite
```

## Base de donnée

- Executer le script de création de table "create_table.sql" dans un fichier db.

```bash
sqlite3 ./db/sport_track.db < ./db/create_db.sql
```

- Modifier si besoin le chemin vers la base de donnée SQLite dans le fichier config.php "DB_FILE"

- Pour tester la base de donnée, executer le script "test_db.sql", et le script "sqlite_connection_test.php" :

```bash
sqlite3 ./db/sport_track.db < ./db/test_db.sql
```

```bash
php sqlite_connection_test.php
```

## Deploiment

Pour lancer l'application:

```bash
php -S localhost:8080
```

Aller sur l'adresse suivante: http://localhost:8080/

## Fonctionnalités

Toutes les functionnalités ont été implementé et tester, avec des gestion d'erreurs. Ce qui comprend donc :

- Creation de compte (avec des sécurités coté HTML, PHP, et SQL, avec des messages d'erreurs).

- Connection (avec des messages d'erreurs).

- Informations lors de la connection.

- Informations lors de la déconnection.

- Modification du compte (avec les memes sécurités que lors de la création de compte).

- Insertions des données avec des fichiers JSON (avec verification du format de fichier, et de l'integrité du fichier).

- Affichage des activités avec la description, la date, le temps de debut, la durée, la distance, et les fréquences cardiaque.

- Affichage des entrées des activités.

- Suppression des activités, et des entrées d'activités.

## Autheurs

- HASCOET Anthony

- MELLION Jean-Loup
