# ⚡ Déploiement GitHub - Guide Express

## 🎯 Déploiement Automatique avec Railway (2 minutes)

Railway se connecte directement à votre repository GitHub et déploie automatiquement à chaque push.

### Étape 1 : Connecter GitHub à Railway

1. **Allez sur** https://railway.app
2. **Cliquez sur** "Start a New Project"
3. **Sélectionnez** "Deploy from GitHub repo"
4. **Autorisez Railway** à accéder à vos repositories GitHub
5. **Choisissez** votre repository : `Arkene235/parfumerie-luxe`

### Étape 2 : Ajouter la Base de Données

1. Dans votre projet Railway, cliquez sur **"+ New"**
2. Sélectionnez **"Database"** → **"MySQL"**
3. Railway créera automatiquement les variables de connexion

### Étape 3 : Configurer les Variables

Allez dans **"Variables"** et ajoutez :

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=(voir ci-dessous)
```

**Pour générer APP_KEY :**
```bash
php artisan key:generate --show
```
Copiez la clé et ajoutez-la comme variable `APP_KEY` dans Railway.

### Étape 4 : C'est Fait ! 🎉

Railway va :
- ✅ Détecter automatiquement que c'est Laravel
- ✅ Installer les dépendances
- ✅ Compiler les assets
- ✅ Exécuter les migrations
- ✅ Démarrer votre application

**Votre URL sera** : `https://parfumerie-luxe-production.up.railway.app`

---

## 🔄 Déploiement Automatique

Désormais, **chaque fois que vous poussez du code sur GitHub** :

```bash
git add .
git commit -m "Votre modification"
git push origin main
```

Railway **déploiera automatiquement** votre application ! 🚀

---

## 📝 Commandes Utiles

### Voir les logs en temps réel
- Allez dans Railway → votre service → "Logs"

### Voir l'historique des déploiements
- Railway → "Deployments"

### Redéployer manuellement
- Railway → "Deployments" → "Redeploy"

---

## 🆘 Problèmes Courants

**Erreur 500 :**
- Vérifiez que `APP_KEY` est défini
- Vérifiez les logs dans Railway

**Base de données vide :**
- Les migrations s'exécutent automatiquement
- Si besoin, allez dans "Settings" → "Deploy" et vérifiez la commande de démarrage

**Assets non chargés :**
- Vérifiez que `npm run build` est dans le build command
- Les assets sont déjà compilés et commités dans votre repo

---

## ✅ Checklist

- [x] Code poussé sur GitHub
- [ ] Railway connecté à GitHub
- [ ] Base de données MySQL créée
- [ ] Variables d'environnement configurées
- [ ] APP_KEY généré et ajouté
- [ ] Premier déploiement réussi

---

**C'est tout ! Votre application se déploiera automatiquement à chaque push sur GitHub.** 🎉

