# Proyecto 1

## Integrantes
* Fernanda González
* C&eacute;sar Rodríguez
* Jos&eacute; Saldaña

## Pre-requisitos
* XAMPP Server con PHP8.2
* Instalar [Composer](https://getcomposer.org/download/) (Instalador de Windows: https://getcomposer.org/Composer-Setup.exe)

## Instalaci&oacute;n

Ejecute los siguientes pasos para correr la aplicaci&oacute;n:
1. En una linea de comandos lo siguiente:
```
composer install
```

2. Agregue la siguiente configuración al archivo `%XAMPP_DIR%\apache\conf\extra\httpd-vhosts.conf`
```
<Directory C:/Projects/Universidad/DesoftVII/2023/proyecto1/public>
     Options Indexes FollowSymLinks Includes ExecCGI
     AllowOverride All
     Require all granted
</Directory>

<VirtualHost *:80>
    ServerAdmin admin@proyecto1.ds7.local
    DocumentRoot "%APP_DIR%/public"
    ServerName proyecto1.ds7.local
    ErrorLog "logs/proyecto1.ds7.local.log"
    CustomLog "logs/proyecto1.ds7.local-access.log" common
</VirtualHost>
```

Cambie la ruta del proyecto del DocumentRoot arriba (`%APP_DIR%`), de acuerdo a donde descomprimió el archivo de la aplicación.

3. Agregue la siguiente entrada al hosts files de su sistema operativo (`c:\Windows\System32\drivers\etc\hosts`)
```
127.0.0.1   proyecto1.ds7.local
```

4. Copie el archivo proyecto1.sqlite al directorio llamadado "database". Debe quedar como
```
APP_DIR\database\proyecto1.sqlite
```

5. Copie el archivo machines.txt al directorio llamadado "storage" y renombrar la extensión del archivo a CSV (machines.csv). Debe quedar como
```
APP_DIR\storage\machines.csv
```

6. Utilizando una consola de comandos, ejecutar el siguiente comando en el directorio de la aplicación. Debe tener el comando php en la variable de entorno Path.
```
php artisan queue:work
```

7. Iniciar XAMPP

8. Abrir su navegador en http://proyecto1.ds7.local

## Contacto
En caso de tener problemas para instalar la aplicación, por favor contacte a José Saldaña via Teams (jose.saldana2@utp.ac.pa) al 62375026.