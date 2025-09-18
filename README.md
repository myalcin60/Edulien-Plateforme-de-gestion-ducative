# Edulien – Plateforme éducative

Edulien est une plateforme éducative développée pour faciliter la gestion des classes, des élèves et des notifications, avec un contrôle des accès basé sur les rôles (enseignant/élève).

## Technologies
- PHP
- MySQL
- HTML / CSS / Bootstrap

## Fonctionnalités
- Création et gestion de classes par les enseignants
- Ajout des élèves par e-mail ou directement
- Gestion des rôles enseignants / élèves
- Système de notifications pour les changements importants

## Structure du projet
EDU_PROJECT/
│
├─ src/
│ ├─ config/ # Configuration de la base de données et constantes
│ ├─ controllers/ # Logique des contrôleurs pour classes, utilisateurs, notifications
│ ├─ repositories/ # Accès aux données et interactions avec la base de données
│ ├─ services/ # Logique métier et traitements intermédiaires
│ ├─ uploads/ # Fichiers téléchargés
│
├─ views/
│ ├─ assets/ # Images, icônes, et autres fichiers statiques
│ ├─ components/ # Composants réutilisables (header, footer, etc.)
│ ├─ css/ # Styles CSS
│ ├─ pages/ # Pages principales
│ ├─ partial/ # Parties de pages réutilisables
│
├─ document/ # Documentation du projet
├─ results/ # Résultats ou exports éventuels
├─ test/ # Tests unitaires et fonctionnels
├─ edu.sql # Script SQL pour la base de données
└─ README.md # Ce fichier




1. Cloner le dépôt :
   ```bash
   git clone https://github.com/myalcin60/Edulien-Plateforme-de-gestion-ducative
2. Importer edu.sql dans votre base de données MySQL.

3. Modifier src/config/db.php avec vos informations de connexion à la base de données.

4. Déployer sur un serveur local ou distant (XAMPP, WAMP, LAMP).

Usage

Accéder à la plateforme via le navigateur.

Créer un compte enseignant pour gérer les classes.

Inviter des élèves et gérer leurs permissions.

Auteur

Musa Yalçın – Développeur principal
