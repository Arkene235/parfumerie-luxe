@echo off
echo ========================================
echo   Configuration MySQL pour Laravel
echo ========================================
echo.

echo Etape 1: Verification de MySQL...
where mysql >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo [ERREUR] MySQL n'est pas dans le PATH
    echo.
    echo Veuillez installer MySQL/MariaDB ou XAMPP
    echo.
    echo Option 1: XAMPP (Recommandee)
    echo   - Telechargez: https://www.apachefriends.org/
    echo   - Installez XAMPP avec MySQL
    echo   - Demarrez MySQL depuis le panneau XAMPP
    echo.
    echo Option 2: MySQL Standalone
    echo   - Telechargez: https://dev.mysql.com/downloads/
    echo.
    pause
    exit /b 1
)

echo [OK] MySQL est installe
echo.

echo Etape 2: Creation de la base de donnees...
echo.
echo Veuillez entrer les informations MySQL:
echo.
set /p DB_HOST="Host (defaut: 127.0.0.1): "
if "%DB_HOST%"=="" set DB_HOST=127.0.0.1

set /p DB_PORT="Port (defaut: 3306): "
if "%DB_PORT%"=="" set DB_PORT=3306

set /p DB_NAME="Nom de la base (defaut: parfumerie_luxe): "
if "%DB_NAME%"=="" set DB_NAME=parfumerie_luxe

set /p DB_USER="Utilisateur (defaut: root): "
if "%DB_USER%"=="" set DB_USER=root

set /p DB_PASS="Mot de passe (laissez vide si aucun): "

echo.
echo Creation de la base de donnees...
mysql -h %DB_HOST% -P %DB_PORT% -u %DB_USER% %DB_PASS% -e "CREATE DATABASE IF NOT EXISTS %DB_NAME% CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo [ERREUR] Impossible de creer la base de donnees
    echo Verifiez vos identifiants MySQL
    pause
    exit /b 1
)

echo [OK] Base de donnees creee
echo.

echo Etape 3: Mise a jour du fichier .env...
echo.
echo Configuration:
echo   DB_CONNECTION=mysql
echo   DB_HOST=%DB_HOST%
echo   DB_PORT=%DB_PORT%
echo   DB_DATABASE=%DB_NAME%
echo   DB_USERNAME=%DB_USER%
echo   DB_PASSWORD=%DB_PASS%
echo.

echo Veuillez mettre a jour manuellement votre fichier .env avec ces valeurs
echo ou executez: php migrate-to-mysql.php
echo.

echo Etape 4: Execution des migrations...
echo.
php artisan migrate:fresh --seed

echo.
echo ========================================
echo   Configuration terminee!
echo ========================================
echo.
pause

