# Guide de Migration vers MySQL

## 📋 Étape 1 : Installation de MySQL/MariaDB

### Option A : XAMPP (Recommandé - Le plus simple)

1. **Télécharger XAMPP**
   - Allez sur : https://www.apachefriends.org/download.html
   - Téléchargez la version pour Windows
   - Installez XAMPP (cochez MySQL lors de l'installation)

2. **Démarrer MySQL**
   - Ouvrez le panneau de contrôle XAMPP
   - Cliquez sur "Start" pour MySQL
   - MySQL sera accessible sur `localhost:3306`

3. **Accéder à phpMyAdmin**
   - Ouvrez votre navigateur
   - Allez sur : http://localhost/phpmyadmin
   - Utilisateur par défaut : `root`
   - Mot de passe : (laissez vide)

### Option B : MySQL Standalone

1. **Télécharger MySQL**
   - Allez sur : https://dev.mysql.com/downloads/installer/
   - Téléchargez "MySQL Installer for Windows"
   - Suivez l'installation

2. **Configurer MySQL**
   - Utilisateur root
   - Mot de passe : (choisissez-en un ou laissez vide pour le développement)

## 📋 Étape 2 : Créer la Base de Données

Une fois MySQL installé, créez la base de données :

**Via phpMyAdmin (XAMPP) :**
1. Allez sur http://localhost/phpmyadmin
2. Cliquez sur "Nouvelle base de données"
3. Nom : `parfumerie_luxe`
4. Interclassement : `utf8mb4_unicode_ci`
5. Cliquez sur "Créer"

**Via ligne de commande :**
```sql
CREATE DATABASE parfumerie_luxe CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## 📋 Étape 3 : Configuration Laravel

Une fois MySQL installé et la base créée, exécutez le script de migration automatique.

