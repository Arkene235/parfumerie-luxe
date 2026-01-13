# 🚀 Guide de Déploiement Gratuit - Laravel E-commerce

## 📋 Options Gratuites Recommandées

### ⭐ Option 1 : Railway (RECOMMANDÉ - Le plus simple)

**Avantages :**
- ✅ Gratuit jusqu'à $5/mois de crédit
- ✅ Configuration automatique de Laravel
- ✅ Base de données MySQL incluse
- ✅ Déploiement en 5 minutes
- ✅ HTTPS automatique
- ✅ Support des variables d'environnement

**Limites gratuites :**
- 500 heures d'exécution/mois
- 5$ de crédit/mois

---

### Option 2 : Render

**Avantages :**
- ✅ Plan gratuit disponible
- ✅ Base de données PostgreSQL gratuite
- ✅ Déploiement automatique depuis GitHub

**Limites gratuites :**
- Service "spin down" après 15 min d'inactivité
- Premier démarrage peut être lent

---

## 🎯 Déploiement sur Railway (Étape par Étape)

### Étape 1 : Préparer le Projet

1. **Créer un compte GitHub** (si vous n'en avez pas)
   - Allez sur https://github.com
   - Créez un compte gratuit

2. **Créer un repository GitHub**
   - Cliquez sur "New repository"
   - Nom : `parfumerie-luxe` (ou autre)
   - Cochez "Public" (gratuit)
   - Cliquez sur "Create repository"

3. **Pousser votre code sur GitHub**

   Ouvrez PowerShell dans votre projet et exécutez :

   ```bash
   # Initialiser git (si pas déjà fait)
   git init
   
   # Ajouter tous les fichiers
   git add .
   
   # Premier commit
   git commit -m "Initial commit"
   
   # Ajouter le remote GitHub (remplacez USERNAME et REPO)
   git remote add origin https://github.com/VOTRE_USERNAME/parfumerie-luxe.git
   
   # Pousser le code
   git branch -M main
   git push -u origin main
   ```

### Étape 2 : Créer un Fichier de Configuration Railway

Créez un fichier `railway.json` à la racine du projet :

```json
{
  "$schema": "https://railway.app/railway.schema.json",
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "startCommand": "php artisan serve --host=0.0.0.0 --port=$PORT",
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

### Étape 3 : Créer un Fichier Procfile

Créez un fichier `Procfile` (sans extension) à la racine :

```
web: php artisan serve --host=0.0.0.0 --port=$PORT
```

### Étape 4 : Mettre à Jour le .env pour la Production

Créez un fichier `.env.example` avec les variables nécessaires (ne pas commit le .env réel) :

```env
APP_NAME="Parfumerie de Luxe"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

# Railway fournira ces valeurs automatiquement
```

### Étape 5 : Déployer sur Railway

1. **Créer un compte Railway**
   - Allez sur https://railway.app
   - Cliquez sur "Start a New Project"
   - Connectez-vous avec GitHub

2. **Créer un nouveau projet**
   - Cliquez sur "New Project"
   - Sélectionnez "Deploy from GitHub repo"
   - Choisissez votre repository `parfumerie-luxe`

3. **Ajouter une base de données MySQL**
   - Dans votre projet Railway, cliquez sur "+ New"
   - Sélectionnez "Database" → "MySQL"
   - Railway créera automatiquement la base de données

4. **Configurer les variables d'environnement**
   - Allez dans "Variables"
   - Railway ajoutera automatiquement les variables de la base de données
   - Ajoutez manuellement :
     ```
     APP_ENV=production
     APP_DEBUG=false
     APP_KEY=(généré automatiquement ou utilisez: php artisan key:generate --show)
     ```

5. **Déployer**
   - Railway détectera automatiquement que c'est un projet Laravel
   - Il installera les dépendances et déploiera
   - Attendez 2-3 minutes

6. **Exécuter les migrations**
   - Une fois déployé, allez dans "Settings" → "Deploy"
   - Ajoutez une commande de build :
     ```
     composer install --no-dev --optimize-autoloader && php artisan migrate --force && php artisan db:seed --force
     ```

7. **Obtenir l'URL**
   - Railway génère automatiquement une URL
   - Exemple : `https://votre-projet.up.railway.app`
   - Vous pouvez aussi ajouter un domaine personnalisé

---

## 🎯 Déploiement sur Render (Alternative)

### Étape 1 : Préparer le Projet

Même préparation que Railway (GitHub repository).

### Étape 2 : Créer un Fichier render.yaml

Créez un fichier `render.yaml` à la racine :

```yaml
services:
  - type: web
    name: parfumerie-luxe
    env: php
    buildCommand: composer install --no-dev --optimize-autoloader && php artisan key:generate --force
    startCommand: php artisan serve --host=0.0.0.0 --port=$PORT
    envVars:
      - key: APP_ENV
        value: production
      - key: APP_DEBUG
        value: false
      - key: LOG_CHANNEL
        value: stack

databases:
  - name: parfumerie-luxe-db
    databaseName: parfumerie_luxe
    user: parfumerie_user
    plan: free
```

### Étape 3 : Déployer sur Render

1. Allez sur https://render.com
2. Créez un compte (gratuit)
3. Connectez votre GitHub
4. Cliquez sur "New" → "Web Service"
5. Sélectionnez votre repository
6. Render détectera automatiquement le fichier `render.yaml`
7. Configurez les variables d'environnement
8. Déployez !

---

## 📝 Checklist Avant le Déploiement

- [ ] Code poussé sur GitHub
- [ ] Fichier `.env` ne contient PAS de secrets (utilisez `.env.example`)
- [ ] `APP_DEBUG=false` en production
- [ ] `APP_ENV=production`
- [ ] Base de données configurée
- [ ] Migrations prêtes à être exécutées
- [ ] Assets compilés (`npm run build`)

---

## 🔧 Commandes Utiles

### Compiler les Assets pour la Production

```bash
npm run build
```

### Générer la Clé d'Application

```bash
php artisan key:generate --show
```

### Optimiser pour la Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## ⚠️ Points Importants

1. **Ne jamais commiter le fichier `.env`**
   - Ajoutez `.env` dans `.gitignore`
   - Utilisez `.env.example` pour la structure

2. **Variables d'environnement sensibles**
   - Ne jamais mettre de clés API dans le code
   - Utilisez les variables d'environnement de la plateforme

3. **Base de données**
   - Railway/Render créent automatiquement les variables DB_*
   - Pas besoin de les configurer manuellement

4. **Assets statiques**
   - Compilez avec `npm run build` avant de pousser
   - Ou configurez la plateforme pour le faire automatiquement

---

## 🎉 Après le Déploiement

1. Testez votre application sur l'URL fournie
2. Vérifiez que les migrations sont exécutées
3. Testez la création de compte
4. Testez l'ajout de produits au panier
5. Vérifiez que les images s'affichent

---

## 🆘 Dépannage

### Erreur 500
- Vérifiez les logs dans Railway/Render
- Vérifiez que `APP_KEY` est défini
- Vérifiez que la base de données est connectée

### Assets non chargés
- Exécutez `npm run build` localement et poussez les fichiers
- Ou configurez la plateforme pour compiler les assets

### Base de données vide
- Exécutez les migrations : `php artisan migrate --force`
- Exécutez les seeders : `php artisan db:seed --force`

---

**Recommandation finale :** Commencez avec **Railway** - c'est le plus simple et le plus rapide pour tester votre application !

