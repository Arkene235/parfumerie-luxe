# 🚀 Déploiement Automatique avec GitHub Actions

## 📋 Options de Déploiement avec GitHub

### Option 1 : Déploiement Automatique vers Railway (Recommandé)

Railway peut se connecter directement à votre repository GitHub et déployer automatiquement à chaque push.

**Avantages :**
- ✅ Déploiement automatique à chaque push sur `main`
- ✅ Pas besoin de GitHub Actions (Railway le fait automatiquement)
- ✅ Configuration en 2 minutes
- ✅ Base de données MySQL incluse

**Configuration :**

1. **Allez sur Railway** : https://railway.app
2. **Créez un nouveau projet** → "Deploy from GitHub repo"
3. **Sélectionnez** votre repository `Arkene235/parfumerie-luxe`
4. **Railway détectera automatiquement** que c'est Laravel
5. **Ajoutez une base de données MySQL**
6. **Configurez les variables d'environnement**
7. **C'est tout !** Chaque push sur `main` déclenchera un déploiement automatique

---

### Option 2 : GitHub Actions + Railway

Si vous voulez plus de contrôle avec GitHub Actions, utilisez le workflow fourni.

**Configuration :**

1. **Obtenez votre token Railway** :
   - Allez sur Railway → Settings → Tokens
   - Créez un nouveau token
   - Copiez-le

2. **Ajoutez les secrets GitHub** :
   - Allez sur votre repository GitHub
   - Settings → Secrets and variables → Actions
   - Ajoutez :
     - `RAILWAY_TOKEN` : votre token Railway
     - `RAILWAY_SERVICE_ID` : l'ID de votre service Railway (trouvable dans l'URL)

3. **Le workflow se déclenchera automatiquement** à chaque push sur `main`

---

### Option 3 : GitHub Actions + Render

Pour déployer sur Render avec GitHub Actions.

**Configuration :**

1. **Créez un compte Render** : https://render.com
2. **Créez un service web** depuis votre repository GitHub
3. **Obtenez votre API key** : Render Dashboard → Account Settings → API Keys
4. **Ajoutez les secrets GitHub** :
   - `RENDER_API_KEY` : votre clé API Render
   - `RENDER_SERVICE_ID` : l'ID de votre service (dans l'URL du service)

---

## 🎯 Configuration Rapide Railway (Recommandé)

### Étape 1 : Connecter GitHub à Railway

1. Allez sur https://railway.app
2. Cliquez sur "Start a New Project"
3. Sélectionnez "Deploy from GitHub repo"
4. Autorisez Railway à accéder à vos repositories
5. Sélectionnez `Arkene235/parfumerie-luxe`

### Étape 2 : Configurer la Base de Données

1. Dans votre projet Railway, cliquez sur "+ New"
2. Sélectionnez "Database" → "MySQL"
3. Railway créera automatiquement :
   - `MYSQL_HOST`
   - `MYSQL_DATABASE`
   - `MYSQL_USER`
   - `MYSQL_PASSWORD`
   - `MYSQL_PORT`

### Étape 3 : Variables d'Environnement

Dans Railway → Variables, ajoutez :

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=(générez avec: php artisan key:generate --show)
```

**Pour générer APP_KEY :**
```bash
php artisan key:generate --show
```

### Étape 4 : Configuration du Build

Dans Railway → Settings → Deploy, configurez :

**Build Command :**
```bash
composer install --no-dev --optimize-autoloader && npm ci && npm run build
```

**Start Command :**
```bash
php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

Ou séparez en deux étapes :

**Build Command :**
```bash
composer install --no-dev --optimize-autoloader && npm ci && npm run build
```

**Start Command :**
```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

**Post Deploy Command (optionnel) :**
```bash
php artisan migrate --force && php artisan db:seed --force
```

### Étape 5 : Déploiement Automatique

Railway déploiera automatiquement :
- ✅ À chaque push sur la branche `main`
- ✅ Les migrations s'exécuteront automatiquement
- ✅ Les seeders s'exécuteront automatiquement
- ✅ Les assets seront compilés automatiquement

---

## 🔄 Workflow de Développement

1. **Développez localement**
2. **Testez votre code**
3. **Commitez et poussez** :
   ```bash
   git add .
   git commit -m "Votre message"
   git push origin main
   ```
4. **Railway déploie automatiquement** 🚀

---

## 📊 Monitoring

Railway vous permet de :
- ✅ Voir les logs en temps réel
- ✅ Voir l'historique des déploiements
- ✅ Monitorer l'utilisation des ressources
- ✅ Configurer des domaines personnalisés

---

## 🆘 Dépannage

### Le déploiement échoue

1. **Vérifiez les logs** dans Railway
2. **Vérifiez les variables d'environnement**
3. **Vérifiez que APP_KEY est défini**
4. **Vérifiez que la base de données est connectée**

### Les assets ne se chargent pas

1. Vérifiez que `npm run build` s'exécute dans le build command
2. Vérifiez que `public/build` est commité (il devrait l'être)

### Erreur 500

1. Vérifiez les logs Railway
2. Vérifiez que toutes les variables d'environnement sont définies
3. Vérifiez que les migrations ont été exécutées

---

## 🎉 C'est Tout !

Une fois configuré, chaque push sur `main` déclenchera automatiquement un déploiement. C'est aussi simple que ça !

**Votre URL sera** : `https://votre-projet.up.railway.app`

