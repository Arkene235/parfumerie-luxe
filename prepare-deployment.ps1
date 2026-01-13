# Script PowerShell pour préparer le déploiement

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Préparation au Déploiement" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Vérifier si git est initialisé
if (-not (Test-Path .git)) {
    Write-Host "Initialisation de Git..." -ForegroundColor Yellow
    git init
    Write-Host "✓ Git initialisé" -ForegroundColor Green
} else {
    Write-Host "✓ Git déjà initialisé" -ForegroundColor Green
}

# Compiler les assets
Write-Host ""
Write-Host "Compilation des assets pour la production..." -ForegroundColor Yellow
npm run build
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Assets compilés" -ForegroundColor Green
} else {
    Write-Host "✗ Erreur lors de la compilation des assets" -ForegroundColor Red
    exit 1
}

# Vérifier .gitignore
Write-Host ""
Write-Host "Vérification de .gitignore..." -ForegroundColor Yellow
$gitignore = Get-Content .gitignore -Raw
if ($gitignore -match "\.env") {
    Write-Host "✓ .env est dans .gitignore" -ForegroundColor Green
} else {
    Write-Host "⚠ .env n'est pas dans .gitignore" -ForegroundColor Yellow
    Add-Content .gitignore "`n.env"
    Write-Host "✓ .env ajouté à .gitignore" -ForegroundColor Green
}

# Générer la clé d'application si nécessaire
Write-Host ""
Write-Host "Vérification de APP_KEY..." -ForegroundColor Yellow
$envContent = Get-Content .env -ErrorAction SilentlyContinue
if ($envContent -match "APP_KEY=") {
    Write-Host "✓ APP_KEY trouvé dans .env" -ForegroundColor Green
    Write-Host ""
    Write-Host "Pour Railway, vous devrez ajouter cette clé comme variable d'environnement:" -ForegroundColor Cyan
    php artisan key:generate --show
} else {
    Write-Host "⚠ APP_KEY non trouvé" -ForegroundColor Yellow
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Prochaines Étapes" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "1. Créez un repository sur GitHub" -ForegroundColor White
Write-Host "2. Ajoutez le remote:" -ForegroundColor White
Write-Host "   git remote add origin https://github.com/VOTRE_USERNAME/votre-repo.git" -ForegroundColor Gray
Write-Host "3. Poussez le code:" -ForegroundColor White
Write-Host "   git add ." -ForegroundColor Gray
Write-Host "   git commit -m 'Ready for deployment'" -ForegroundColor Gray
Write-Host "   git branch -M main" -ForegroundColor Gray
Write-Host "   git push -u origin main" -ForegroundColor Gray
Write-Host "4. Allez sur https://railway.app et déployez !" -ForegroundColor White
Write-Host ""
Write-Host "Consultez DEPLOIEMENT_RAPIDE.md pour plus de détails." -ForegroundColor Cyan
Write-Host ""

