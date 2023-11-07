# Proyecto 1

## Integrantes
* Fernanda González
* C&eacute;sar Rodríguez
* Jos&eacute; Saldaña

## Pre-requisitos
* XAMPP Server con PHP8.2

## Instalaci&oacute;n

Ejecute los siguientes pasos para correr la aplicaci&oacute;n:

1. Agregue la siguiente configuración al archivo %XAMPP_DIR%\apache\conf\extra\httpd-vhosts.conf
```
<VirtualHost *:80>
    ServerAdmin admin@proyecto1.ds7.local
    DocumentRoot "<ruta-del-proyecto>/public"
    ServerName proyecto1.ds7.local
    ErrorLog "logs/proyecto1.ds7.local.log"
    CustomLog "logs/proyecto1.ds7.local-access.log" common
</VirtualHost>
```

Cambie la ruta del proyecto del DocumentRoot arriba, de acuerdo a donde descomprimió el archivo de la aplicación.

2. Agregue la siguiente entrada al hosts files de su sistema operativo (`c:\Windows\System32\drivers\etc\hosts`)
```
127.0.0.1   proyecto1.ds7.local
```

3. Copie el archivo machines.txt al directorio llamadado "storage" y renombrar la extensión del archivo a CSV (machines.csv). Debe quedar como
```
APP_DIR\storage\machines.csv
```

4. Utilizando una consola de comandos, ejecutar el siguiente comando en el directorio de la aplicación. Debe tener el comando php en la variable de entorno Path.
```
php artisan queue:work
```

5. Iniciar XAMPP

6. Abrir su navegador en http://proyecto1.ds7.local y disfrute.

## Contacto
En caso de tener problemas para instalar la aplicación, por favor contacte a José Saldaña via Teams (jose.saldana2@utp.ac.pa) al 62375026.