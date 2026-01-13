# Boutique en Ligne avec Laravel 12

Une boutique en ligne simple utilisant Laravel 12, Vue.js, Inertia.js, et Tailwind CSS (VILT stack).

## Fonctionnalités

- Catalogue de produits (base de données)
- Panier d'achat (sessions)
- Paiement avec Stripe (optionnel)
- Historique des commandes (utilisateur)

## Installation

1. Cloner le projet ou utiliser le code existant.

2. Installer les dépendances PHP :
   ```bash
   composer install
   ```

3. Installer les dépendances Node.js :
   ```bash
   npm install --legacy-peer-deps
   ```

4. Configurer l'environnement :
   - Copier `.env.example` vers `.env`
   - Générer la clé d'application : `php artisan key:generate`
   - Configurer la base de données (SQLite par défaut)
   - Ajouter les clés Stripe dans `.env` :
     ```
     STRIPE_KEY=pk_test_...
     STRIPE_SECRET=sk_test_...
     VITE_STRIPE_KEY=pk_test_...
     ```

5. Migrer la base de données :
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. Construire les assets :
   ```bash
   npm run build
   ```

7. Démarrer le serveur :
   ```bash
   php artisan serve
   ```

## Utilisation

- Accéder à `/products` pour voir le catalogue.
- S'inscrire/Se connecter pour accéder au panier et aux commandes.
- Ajouter des produits au panier.
- Procéder au paiement (nécessite des clés Stripe valides pour le paiement réel).

## Technologies

- Laravel 12
- Vue.js 3
- Inertia.js
- Tailwind CSS
- Stripe pour les paiements

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
