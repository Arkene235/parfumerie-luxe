<?php

/**
 * Script de Vérification pour le Déploiement
 * 
 * Vérifie que votre projet est prêt pour le déploiement
 */

echo "========================================\n";
echo "  Vérification du Déploiement\n";
echo "========================================\n\n";

$errors = [];
$warnings = [];

// 1. Vérifier que .env n'est pas dans git
echo "1. Vérification des fichiers sensibles...\n";
if (file_exists('.git')) {
    $gitignore = file_get_contents('.gitignore');
    if (strpos($gitignore, '.env') === false) {
        $errors[] = ".env n'est pas dans .gitignore !";
    } else {
        echo "   ✓ .env est dans .gitignore\n";
    }
} else {
    $warnings[] = "Git n'est pas initialisé";
}

// 2. Vérifier les fichiers de configuration
echo "\n2. Vérification des fichiers de configuration...\n";
$requiredFiles = ['railway.json', 'Procfile', '.env.example'];
foreach ($requiredFiles as $file) {
    if (file_exists($file)) {
        echo "   ✓ $file existe\n";
    } else {
        $warnings[] = "$file n'existe pas (créé automatiquement)";
    }
}

// 3. Vérifier que les assets sont compilés
echo "\n3. Vérification des assets...\n";
if (file_exists('public/build/manifest.json')) {
    echo "   ✓ Assets compilés trouvés\n";
} else {
    $warnings[] = "Les assets ne sont pas compilés. Exécutez 'npm run build' avant le déploiement.";
}

// 4. Vérifier composer.json
echo "\n4. Vérification des dépendances...\n";
if (file_exists('composer.json')) {
    echo "   ✓ composer.json existe\n";
    $composer = json_decode(file_get_contents('composer.json'), true);
    if (isset($composer['require']['laravel/framework'])) {
        echo "   ✓ Laravel détecté\n";
    }
} else {
    $errors[] = "composer.json n'existe pas !";
}

// 5. Vérifier package.json
echo "\n5. Vérification des dépendances frontend...\n";
if (file_exists('package.json')) {
    echo "   ✓ package.json existe\n";
} else {
    $warnings[] = "package.json n'existe pas";
}

// 6. Vérifier les migrations
echo "\n6. Vérification des migrations...\n";
$migrationsPath = 'database/migrations';
if (is_dir($migrationsPath)) {
    $migrations = glob($migrationsPath . '/*.php');
    echo "   ✓ " . count($migrations) . " migrations trouvées\n";
} else {
    $errors[] = "Le dossier database/migrations n'existe pas !";
}

// Résumé
echo "\n========================================\n";
echo "  Résumé\n";
echo "========================================\n\n";

if (empty($errors) && empty($warnings)) {
    echo "✅ Votre projet est prêt pour le déploiement !\n\n";
    echo "Prochaines étapes :\n";
    echo "1. Poussez votre code sur GitHub\n";
    echo "2. Créez un compte sur Railway (https://railway.app)\n";
    echo "3. Connectez votre repository GitHub\n";
    echo "4. Railway déploiera automatiquement votre application\n\n";
} else {
    if (!empty($errors)) {
        echo "❌ ERREURS (à corriger) :\n";
        foreach ($errors as $error) {
            echo "   - $error\n";
        }
        echo "\n";
    }
    
    if (!empty($warnings)) {
        echo "⚠️  AVERTISSEMENTS :\n";
        foreach ($warnings as $warning) {
            echo "   - $warning\n";
        }
        echo "\n";
    }
}

echo "Consultez GUIDE_DEPLOIEMENT_GRATUIT.md pour plus de détails.\n";

