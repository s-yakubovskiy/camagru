<?php
    // docker run --name mysql-db -p 3306:3306 -e MYSQL_ROOT_PASSWORD='root' -d mysql:5.7
    // use docker-machine Camagru (it has ip address of 192.168.99.100)
    // docker exec -it mysql-db /bin/bash
    // mysql -u root -p
    // in docker mysql run
    // GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;

    // recent version of mysql has default plugin as caching_sha-2...
    // therefore must use earlier version or change the default plugin in .env file
    
    // I can use 127.0.0.1 as $DB_DNS if I can open mysql server on this mac.

    $host = getenv('DB_HOST');
    $port = getenv('DB_PORT');
    $user = getenv('DB_USER');
    $password = getenv('DB_PASSWORD');
    $name = getenv('DB_NAME');

    $DB_HOST = $host ? $host : 'localhost';
    $DB_PORT = $port ? $port : '3306';
    $DB_USER = $user ? $user : 'root';
    $DB_PASSWORD = $password ? $password : 'levon123';
    $DB_NAME = $name ? $name : 'db_camagru';
?>
