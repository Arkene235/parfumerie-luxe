# 🚀 Guide d'Installation MySQL - Étape par Étape

## 📦 Étape 1 : Installer MySQL/MariaDB

### Option A : XAMPP (⭐ RECOMMANDÉ - Le plus simple)

1. **Télécharger XAMPP**
   - Allez sur : https://www.apachefriends.org/download.html
   - Téléchargez la version Windows (environ 150 MB)
   - Exécutez l'installateur

2. **Installation**
   - Cochez **MySQL** et **phpMyAdmin** lors de l'installation
   - Choisissez un dossier d'installation (par défaut : `C:\xampp`)
   - Cliquez sur "Install"

3. **Démarrer MySQL**
   - Ouvrez le **Panneau de Contrôle XAMPP**
   - Cliquez sur **"Start"** pour MySQL
   - Le bouton devrait devenir vert ✅

4. **Vérifier l'installation**
   - Ouvrez votre navigateur
   - Allez sur : **http://localhost/phpmyadmin**
   - Vous devriez voir l'interface phpMyAdmin

### Option B : MySQL Standalone

1. **Télécharger MySQL**
   - Allez sur : https://dev.mysql.com/downloads/installer/
   - Téléchargez "MySQL Installer for Windows"
   - Choisissez "Developer Default" ou "Server only"

2. **Installation**
   - Suivez l'assistant d'installation
   - Configurez le mot de passe root (ou laissez vide pour le développement)
   - Terminez l'installation

## 📋 Étape 2 : Créer la Base de Données

### Via phpMyAdmin (XAMPP)

1. Allez sur **http://localhost/phpmyadmin**
2. Cliquez sur l'onglet **"Bases de données"**
3. Dans "Créer une base de données" :
   - Nom : `parfumerie_luxe`
   - Interclassement : `utf8mb4_unicode_ci`
4. Cliquez sur **"Créer"**

### Via Ligne de Commande

Ouvrez un terminal et exécutez :

```bash
mysql -u root -e "CREATE DATABASE parfumerie_luxe CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

## ⚙️ Étape 3 : Configurer Laravel

### Méthode Automatique (Recommandée)

1. **Exécutez le script de migration** :
   ```bash
   php migrate-to-mysql.php
   ```

2. Le script vous demandera :
   - Host : `127.0.0.1` (ou appuyez sur Entrée)
   - Port : `3306` (ou appuyez sur Entrée)
   - Base de données : `parfumerie_luxe` (ou appuyez sur Entrée)
   - Utilisateur : `root` (ou appuyez sur Entrée)
   - Mot de passe : (laissez vide si aucun, ou entrez votre mot de passe)

3. Le script va :
   - ✅ Tester la connexion MySQL
   - ✅ Créer la base de données si nécessaire
   - ✅ Mettre à jour le fichier `.env`
   - ✅ Exécuter les migrations
   - ✅ Remplir la base avec les données de test

### Méthode Manuelle

1. **Ouvrez le fichier `.env`** à la racine du projet

2. **Modifiez ces lignes** :
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=parfumerie_luxe
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   *(Laissez `DB_PASSWORD` vide si vous n'avez pas de mot de passe)*

3. **Exécutez les migrations** :
   ```bash
   php artisan migrate:fresh --seed
   ```

## ✅ Étape 4 : Vérifier que tout fonctionne

1. **Démarrez le serveur Laravel** :
   ```bash
   php artisan serve
   ```

2. **Ouvrez votre navigateur** :
   - Allez sur : http://localhost:8000
   - Vérifiez que les produits s'affichent
   - Testez la création d'un compte utilisateur

3. **Vérifiez la base de données** :
   - Allez sur : http://localhost/phpmyadmin
   - Sélectionnez la base `parfumerie_luxe`
   - Vérifiez que les tables existent

## 🔧 Dépannage

### Erreur : "Access denied for user 'root'@'localhost'"

**Solution :**
- Vérifiez que MySQL est démarré (XAMPP)
- Vérifiez le mot de passe dans `.env`
- Si vous avez défini un mot de passe, ajoutez-le dans `.env`

### Erreur : "Unknown database 'parfumerie_luxe'"

**Solution :**
- Créez la base de données manuellement via phpMyAdmin
- Ou exécutez : `mysql -u root -e "CREATE DATABASE parfumerie_luxe;"`

### Erreur : "Connection refused"

**Solution :**
- Vérifiez que MySQL est démarré
- Vérifiez le port (par défaut : 3306)
- Vérifiez que le firewall n'bloque pas MySQL

## 📊 Avantages de MySQL vs SQLite

| Fonctionnalité | SQLite | MySQL |
|----------------|--------|-------|
| Utilisateurs multiples | ❌ | ✅ |
| Production | ❌ | ✅ |
| Performance | ⭐⭐ | ⭐⭐⭐⭐ |
| Gestion facile | ✅ | ✅ |
| Sauvegarde | Fichier | Outils professionnels |

## 🎯 Prochaines Étapes

Une fois MySQL configuré :
1. ✅ Votre application sera prête pour la production
2. ✅ Vous pourrez gérer plusieurs utilisateurs simultanément
3. ✅ Les performances seront meilleures
4. ✅ Vous pourrez faire des sauvegardes facilement

---

**Besoin d'aide ?** Exécutez `php migrate-to-mysql.php` pour une migration automatique !

