# Containers
```bash
docker run --name tragamillas -d -p 80:80 -p 443:443 -v nginx-web:/var/www/html:ro -v nginx-conf:/etc/nginx/sites-enabled:ro richarvey/nginx-php-fpm
```
```bash
docker run --name mysql -p 3306:3306 -v mysql-bbdd:/var/lib -v mysql-conf:/etc/mysql -e MYSQL_ROOT_PASSWORD=toor -d mysql
```
```bash
docker run --name pma -d --link mysqlSBR:db -p 8080:80 phpmyadmin
```

# Networks
```bash
docker network create tragamillas
```
```bash
docker network connect tragamillas tragamillas
```
```bash
docker network connect tragamillas mysql
```
```bash
docker network connect tragamillas pma
```