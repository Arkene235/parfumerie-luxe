# 🚀 Déploiement Rapide - Guide Express

## ⚡ Déploiement en 5 Minutes avec Railway

### Étape 1 : Préparer GitHub (2 min)

```bash
# Si git n'est pas initialisé
git init
git add .
git commit -m "Ready for deployment"

# Créer un repository sur GitHub, puis :
git remote add origin https://github.com/VOTRE_USERNAME/votre-repo.git
git branch -M main
git push -u origin main
```

### Étape 2 : Déployer sur Railway (3 min)

1. **Allez sur** https://railway.app
2. **Cliquez sur** "Start a New Project"
3. **Connectez** votre compte GitHub
4. **Sélectionnez** "Deploy from GitHub repo"
5. **Choisissez** votre repository
6. **Ajoutez une base de données** :
   - Cliquez sur "+ New" → "Database" → "MySQL"
7. **Configurez les variables** :
   - Allez dans "Variables"
   - Ajoutez :
     ```
     APP_ENV=production
     APP_DEBUG=false
     ```
8. **Générez la clé d'application** :
   - Dans votre terminal local : `php artisan key:generate --show`
   - Copiez la clé et ajoutez-la comme variable `APP_KEY` dans Railway
9. **Exécutez les migrations** :
   - Dans Railway, allez dans "Settings" → "Deploy"
   - Ajoutez dans "Build Command" :
     ```
     composer install --no-dev --optimize-autoloader && php artisan migrate --force && php artisan db:seed --force
     ```

### Étape 3 : Compiler les Assets

Dans votre terminal local :

```bash
npm run build
git add public/build
git commit -m "Build assets"
git push
```

### Étape 4 : C'est Fait ! 🎉

Railway vous donnera une URL comme : `https://votre-projet.up.railway.app`

---

## 🔧 Commandes Utiles

### Compiler les assets pour la production
```bash
npm run build
```

### Vérifier que tout est prêt
```bash
php check-deployment-ready.php
```

### Générer la clé d'application
```bash
php artisan key:generate --show
```

---

## ⚠️ Important

- ✅ Ne commitez JAMAIS le fichier `.env`
- ✅ Utilisez `APP_DEBUG=false` en production
- ✅ Compilez les assets avec `npm run build` avant de pousser
- ✅ Railway créera automatiquement les variables de base de données

---

## 🆘 Problèmes Courants

**Erreur 500 :**
- Vérifiez que `APP_KEY` est défini dans Railway
- Vérifiez les logs dans Railway

**Assets non chargés :**
- Exécutez `npm run build` et poussez les fichiers `public/build`

**Base de données vide :**
- Les migrations s'exécutent automatiquement avec la commande de build

---

**Besoin d'aide ?** Consultez `GUIDE_DEPLOIEMENT_GRATUIT.md` pour plus de détails.

