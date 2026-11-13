@echo off
chcp 65001 > nul
title Đẩy Code lên GitHub - Laravel Inventory Management System
cd /D "%~dp0"
echo ======================================================================
echo   HỆ THỐNG QUẢN LÝ KHO IMS - ĐẨY CODE LÊN GITHUB
echo   Tài khoản: tranphuckhang56dvn-byte
echo ======================================================================
echo.

set "PATH=C:\Users\%USERNAME%\.mingit\cmd;C:\Program Files\Git\cmd;%PATH%"

REM Cấu hình mã hoá UTF-8 cho Git
git config --local i18n.commitEncoding utf-8
git config --local i18n.logOutputEncoding utf-8
git config --local core.quotepath false

echo [*] Danh sách commit chuẩn bị đẩy lên GitHub:
git log origin/main..HEAD --oneline
echo.
echo [*] Đang thực hiện: git push origin main ...
echo.

git push origin main

echo.
if %errorlevel% equ 0 (
    echo [OK] Đẩy code lên GitHub thành công!
) else (
    echo [!] Có lỗi xảy ra trong quá trình push. Vui lòng kiểm tra kết nối hoặc quyền truy cập.
)
echo ======================================================================
pause
