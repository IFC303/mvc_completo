# tragamillas
```bash
docker run --name nginxSBR -d -p 80:80 -p 443:443 -v nginx-web:/var/www/html:ro -v nginx-conf:/etc/nginx/sites-enabled:ro richarvey/nginx-php-fpm
```
```bash
docker run --name mysqlSBR -p 3306:3306 -v mysql-bbdd:/var/lib -v mysql-conf:/etc/mysql -e MYSQL_ROOT_PASSWORD=alumno -d mysql
```
```bash
docker run --name myadmSBR -d --link mysqlSBR:db -p 8080:80 phpmyadmin
```
