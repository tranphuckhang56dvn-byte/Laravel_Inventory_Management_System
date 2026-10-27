@echo off
title Laravel Inventory Management System - Local Server
echo ========================================================
echo   KHOI DONG HE THONG QUAN LY KHO (LOCAL SERVER)
echo ========================================================
echo.

set "PATH=C:\xampp\php;E:\laragon\bin\php\php-8.3.33-Win32-vs16-x64;C:\Program Files\Git\cmd;%PATH%"

where php >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo [LOI] Khong tim thay PHP trong C:\xampp\php hoac E:\laragon!
    echo Vui long kiem tra lai duong dan PHP.
    pause
    exit /b 1
)

echo May chu Web Server: http://127.0.0.1:8000
echo Nhan Ctrl + C de dung server.
echo ========================================================
echo.
php artisan serve
pause
