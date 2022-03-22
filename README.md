# Manual
```bash
docker run --name tragamillas -d -p 80:80 -p 443:443 -v nginx-web:/var/www/html:ro -v nginx-conf:/etc/nginx/sites-enabled:ro richarvey/nginx-php-fpm
```
```bash
docker run --name mysql -p 3306:3306 -v mysql-bbdd:/var/lib -v mysql-conf:/etc/mysql -e MYSQL_ROOT_PASSWORD=toor -d mysql
```
```bash
docker run --name pma -d --link mysqlSBR:db -p 8080:80 phpmyadmin
```

# Compose
```bash
git clone https://github.com/IFC303/tragamillas && cd tragamillas
```
```bash
mkdir docker/nginx/ssl && openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout docker/nginx/ssl/privkey.pem -out docker/nginx/ssl/fullchain.pem
```
```bash
docker pull ifc303/tragamillas && docker-compose up -d
```