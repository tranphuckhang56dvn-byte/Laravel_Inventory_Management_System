@echo off
title Push Code to GitHub
cd /D "%~dp0"
echo ========================================================
echo   PUSH CODE LEN GITHUB: tranphuckhang56dvn-byte
echo ========================================================
echo.
set "PATH=C:\Users\%USERNAME%\.mingit\cmd;C:\Program Files\Git\cmd;%PATH%"

git push origin main

echo.
echo ========================================================
pause
