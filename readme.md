

# ⌨️ Q&A API

<p align="center">L'objectif de ce projet était de créer une API de questions et réponses. Pour chaque question créée, il est possible d'avoir plus d'une réponse. Les valeurs sont enregistrées dans les tables "Question" et "Réponse" de la base de données PostgreSQL.</p>

📑 Indice
=================
<!--ts-->
   * ⌨️ [Q&A API](#-q&a-api)
   * 📑 [Indice](#-indice)
   * 💡 [Pré-requis](#-pré-requis)
   * 🎲 [Exécution de l'application](#-exécution-de-l'application)
   * 🛠  [Technologie](#-technologie)
   * 👨‍💻 [Auteur](#-auteur)
<!--te-->

<h4 align="center"> 
	✅  Symfony + PostgreSQL 🚀 80%  ✅
</h4>

### 💡 Pré-requis

Avant de commencer, les outils suivants doivent être installés sur votre ordinateur:
[Git](https://git-scm.com), [PHP](https://www.php.net/), [PostgreSQL](https://www.postgresql.org/), [Composer](https://getcomposer.org/). 

Il serait également utile de disposer d'un éditeur pour travailler avec le code, tel que [VSCode](https://code.visualstudio.com/).

Après l'installation de PostgreSQL, créez un nom d'utilisateur et un mot de passe.

### 🎲 Exécution de l'application

```bash
POUR WINDOWS:
# Ouvrez CMD et clonez le dépôt
$ git clone https://github.com/HassanOliveira/SmartTribune-Symfony projet_hassan

# Ouvrir le projet avec Visual Studio Code
$ code projet_hassan

# Exécutez la commande suivante pour installer les dépendances de Composer :
$ install composer
```

Configurez maintenant les données de la base de données dans le fichier "configpackages\doctrine.yaml":

dbname : 'db_smarttribune_hassan' # Nom de la base de données
        user : 'hassan' # Nom d'utilisateur de la base de données
        password : '123456' # Mot de passe

Modifiez également l'URL dans le fichier ".env" :

DATABASE_URL=postgresql://hassan:123456@127.0.0.1:5432/db_smarttribune_hassan

bash
```
# Exécuter la commande de création d'une base de données
php bin/console doctrine:database:create

# Migrer
$ php bin/console doctrine:migrations:migrate

# Exécuter les tests
$ php bin/phpunit
```

Avec un gestionnaire de base de données tel que pgAdmin, vous pouvez visualiser les tables et les données sauvegardées.

Le dossier "tests" contient les codes de test qui ont été exécutés.


### 🛠 Technologie

Les outils suivants ont été utilisés pour créer le projet:

- [PHP](https://www.php.net/)
- [PostgreSQL](https://www.postgresql.org/)

### 👨‍💻 Auteur

<a href="https://www.linkedin.com/in/hassanaboliveira/">
 <img style="border-radius: 50%;" src="https://media.licdn.com/dms/image/D4E03AQHjlBTrs5MBPg/profile-displayphoto-shrink_800_800/0/1669495824560?e=1699488000&v=beta&t=OtvYsF9WlSiq-vXV4nDs-WzsFWaf68AAiDatl-W00Sw" width="130px;" alt="Me"/>
 <br />
 <sub><b>Hassan Bittencourt</b></sub></a> <a href="https://www.linkedin.com/in/hassanaboliveira/" title="Hassan Bittencourt">🚀</a>

Made with ❤️ by Hassan Bittencourt 👋🏽 Contact me!

[![Linkedin Badge](https://img.shields.io/badge/-LinkedIn-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/hassanaboliveira/)](https://www.linkedin.com/in/hassanaboliveira/)
[![Hotmail Badge](https://img.shields.io/badge/-Hotmail-0078D4?style=flat-square&logo=microsoft-outlook&logoColor=white&link=mailto:hassan_bittencourt@hotmail.com)](mailto:hassan_bittencourt@hotmail.com)
