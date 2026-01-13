<?php

/**
 * Script de Migration SQLite vers MySQL
 * 
 * Ce script vous aide à migrer votre base de données SQLite vers MySQL
 * 
 * UTILISATION:
 * 1. Assurez-vous que MySQL est installé et démarré
 * 2. Créez la base de données 'parfumerie_luxe' dans MySQL
 * 3. Exécutez: php migrate-to-mysql.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "========================================\n";
echo "  Migration SQLite vers MySQL\n";
echo "========================================\n\n";

// Étape 1: Vérifier la connexion SQLite
echo "1. Vérification de la connexion SQLite...\n";
try {
    $sqlitePath = database_path('database.sqlite');
    if (!file_exists($sqlitePath)) {
        throw new Exception("Fichier SQLite non trouvé: $sqlitePath");
    }
    echo "   ✓ Fichier SQLite trouvé\n";
} catch (Exception $e) {
    echo "   ✗ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}

// Étape 2: Demander les informations MySQL
echo "\n2. Configuration MySQL\n";
echo "   Veuillez entrer les informations de connexion MySQL:\n\n";

$host = readline("   Host (défaut: 127.0.0.1): ") ?: '127.0.0.1';
$port = readline("   Port (défaut: 3306): ") ?: '3306';
$database = readline("   Nom de la base de données (défaut: parfumerie_luxe): ") ?: 'parfumerie_luxe';
$username = readline("   Utilisateur (défaut: root): ") ?: 'root';
$password = readline("   Mot de passe (laissez vide si aucun): ");

// Étape 3: Tester la connexion MySQL
echo "\n3. Test de connexion MySQL...\n";
try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "   ✓ Connexion MySQL réussie\n";
    
    // Vérifier si la base existe
    $stmt = $pdo->query("SHOW DATABASES LIKE '$database'");
    if ($stmt->rowCount() === 0) {
        echo "\n   La base de données '$database' n'existe pas.\n";
        $create = readline("   Voulez-vous la créer maintenant? (o/n): ");
        if (strtolower($create) === 'o' || strtolower($create) === 'oui' || strtolower($create) === 'y' || strtolower($create) === 'yes') {
            $pdo->exec("CREATE DATABASE `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            echo "   ✓ Base de données créée\n";
        } else {
            echo "   ✗ Veuillez créer la base de données manuellement\n";
            exit(1);
        }
    } else {
        echo "   ✓ Base de données trouvée\n";
    }
    
    $pdo = null;
} catch (PDOException $e) {
    echo "   ✗ Erreur de connexion: " . $e->getMessage() . "\n";
    echo "\n   Vérifiez que:\n";
    echo "   - MySQL est installé et démarré\n";
    echo "   - Les informations de connexion sont correctes\n";
    exit(1);
}

// Étape 4: Mettre à jour le fichier .env
echo "\n4. Mise à jour du fichier .env...\n";
$envPath = base_path('.env');
if (!file_exists($envPath)) {
    echo "   ✗ Fichier .env non trouvé\n";
    exit(1);
}

$envContent = file_get_contents($envPath);

// Sauvegarder l'ancienne configuration
$backupPath = base_path('.env.sqlite.backup');
file_put_contents($backupPath, $envContent);
echo "   ✓ Sauvegarde créée: .env.sqlite.backup\n";

// Mettre à jour la configuration
$envContent = preg_replace('/DB_CONNECTION=.*/', "DB_CONNECTION=mysql", $envContent);
$envContent = preg_replace('/DB_HOST=.*/', "DB_HOST=$host", $envContent);
$envContent = preg_replace('/DB_PORT=.*/', "DB_PORT=$port", $envContent);
$envContent = preg_replace('/DB_DATABASE=.*/', "DB_DATABASE=$database", $envContent);
$envContent = preg_replace('/DB_USERNAME=.*/', "DB_USERNAME=$username", $envContent);
$envContent = preg_replace('/DB_PASSWORD=.*/', "DB_PASSWORD=$password", $envContent);

// Si les lignes n'existent pas, les ajouter
if (strpos($envContent, 'DB_CONNECTION') === false) {
    $envContent .= "\nDB_CONNECTION=mysql\n";
}
if (strpos($envContent, 'DB_HOST') === false) {
    $envContent .= "DB_HOST=$host\n";
}
if (strpos($envContent, 'DB_PORT') === false) {
    $envContent .= "DB_PORT=$port\n";
}
if (strpos($envContent, 'DB_DATABASE') === false) {
    $envContent .= "DB_DATABASE=$database\n";
}
if (strpos($envContent, 'DB_USERNAME') === false) {
    $envContent .= "DB_USERNAME=$username\n";
}
if (strpos($envContent, 'DB_PASSWORD') === false) {
    $envContent .= "DB_PASSWORD=$password\n";
}

file_put_contents($envPath, $envContent);
echo "   ✓ Fichier .env mis à jour\n";

// Étape 5: Exécuter les migrations
echo "\n5. Exécution des migrations...\n";
echo "   Exécution de: php artisan migrate:fresh --seed\n\n";

// Changer temporairement la configuration
config(['database.default' => 'mysql']);
config(['database.connections.mysql.host' => $host]);
config(['database.connections.mysql.port' => $port]);
config(['database.connections.mysql.database' => $database]);
config(['database.connections.mysql.username' => $username]);
config(['database.connections.mysql.password' => $password]);

// Utiliser la méthode Laravel pour exécuter les migrations
echo "   Exécution des migrations en cours...\n";
echo "   (Cela peut prendre quelques secondes)\n\n";

// Note: Les migrations doivent être exécutées via artisan en ligne de commande
// car le script ne peut pas changer la config dynamiquement
echo "   ⚠ IMPORTANT: Après la mise à jour du .env, exécutez:\n";
echo "   php artisan config:clear\n";
echo "   php artisan migrate:fresh --seed\n\n";

echo "\n========================================\n";
echo "  Migration terminée avec succès! ✓\n";
echo "========================================\n\n";
echo "Prochaines étapes:\n";
echo "1. Testez votre application: php artisan serve\n";
echo "2. Vérifiez que tout fonctionne correctement\n";
echo "3. La sauvegarde SQLite est toujours disponible si besoin\n\n";

