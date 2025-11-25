# Script para configurar Laragon para usar phpMyAdmin en lugar de HeidiSQL
# Ejecutar como Administrador

Write-Host "Configurando Laragon para usar phpMyAdmin..." -ForegroundColor Green

# Verificar que phpMyAdmin esté instalado
$phpMyAdminPath = "C:\laragon\etc\apps\phpMyAdmin"
if (-not (Test-Path $phpMyAdminPath)) {
    Write-Host "ERROR: phpMyAdmin no está instalado en $phpMyAdminPath" -ForegroundColor Red
    Write-Host "Por favor, instala phpMyAdmin primero." -ForegroundColor Yellow
    exit 1
}

# Verificar que Apache esté configurado para servir phpMyAdmin
$apacheConfigPath = "C:\laragon\etc\apache2\extra\httpd-vhosts.conf"
if (Test-Path $apacheConfigPath) {
    $vhostsContent = Get-Content $apacheConfigPath -Raw

    # Verificar si ya existe la configuración de phpMyAdmin
    if ($vhostsContent -notmatch "phpmyadmin") {
        Write-Host "Agregando configuración de phpMyAdmin a Apache..." -ForegroundColor Yellow

        $phpMyAdminConfig = @"

# phpMyAdmin Configuration
Alias /phpmyadmin "C:/laragon/etc/apps/phpMyAdmin/"
<Directory "C:/laragon/etc/apps/phpMyAdmin/">
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
"@

        Add-Content -Path $apacheConfigPath -Value $phpMyAdminConfig
        Write-Host "Configuración de phpMyAdmin agregada a Apache." -ForegroundColor Green
    } else {
        Write-Host "phpMyAdmin ya está configurado en Apache." -ForegroundColor Green
    }
}

# Crear acceso directo a phpMyAdmin
$shortcutPath = "$env:USERPROFILE\Desktop\phpMyAdmin.lnk"
$WScriptShell = New-Object -ComObject WScript.Shell
$Shortcut = $WScriptShell.CreateShortcut($shortcutPath)
$Shortcut.TargetPath = "http://localhost/phpmyadmin"
$Shortcut.Save()

Write-Host "`n========================================" -ForegroundColor Cyan
Write-Host "Configuración completada!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "`nPara usar phpMyAdmin en Laragon:" -ForegroundColor Yellow
Write-Host "1. Abre Laragon" -ForegroundColor White
Write-Host "2. Haz clic derecho en el icono de Laragon en la bandeja del sistema" -ForegroundColor White
Write-Host "3. Ve a 'Menu' > 'Preferences' o 'Database' > 'phpMyAdmin'" -ForegroundColor White
Write-Host "4. O simplemente abre: http://localhost/phpmyadmin en tu navegador" -ForegroundColor White
Write-Host "`nTambién puedes usar el acceso directo creado en tu escritorio." -ForegroundColor Cyan
Write-Host "`nNota: Si Laragon no tiene la opción en el menú, reinicia Laragon después de ejecutar este script." -ForegroundColor Yellow



