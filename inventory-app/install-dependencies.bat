@echo off
REM Install Laravel Dependencies using Composer

echo Installing Laravel dependencies...
echo.

REM Download composer.phar if not exists
if not exist composer.phar (
    echo Downloading Composer...
    E:\xampp\php\php.exe -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    E:\xampp\php\php.exe composer-setup.php
    del composer-setup.php
)

REM Install dependencies
echo Running composer install...
E:\xampp\php\php.exe composer.phar install

echo.
echo Installation complete!
pause
