#! /bin/bash
export MARIADB_IMAGE=mariadb_web-libros
export PHPAPACHE_IMAGE=phpapache_mysqli
export MARIADB_CONTAINER=mariadbdev_web-libros
export WEBSERVER_CONTAINER=phpapachedev_web-libros
export DB_NAME=web-libros
export MARIADB_USER=web-libros
export ROOT_PASSWORD=$(openssl rand -base64 32)
export PASSWORD=$(openssl rand -base64 32)
export NETWORK=weblibros-dev.net

docker stop $MARIADB_CONTAINER $WEBSERVER_CONTAINER
docker rm $MARIADB_CONTAINER $WEBSERVER_CONTAINER
docker rmi $MARIADB_IMAGE $PHPAPACHE_IMAGE
docker network rm $NETWORK
docker network create $NETWORK

docker build \
--build-arg DB_HOSTNAME=$MARIADB_CONTAINER \
--build-arg DB_USERNAME=$MARIADB_USER \
--build-arg DB_PASSWORD=$PASSWORD \
-t $PHPAPACHE_IMAGE -f ./dockerfiles/php-apache/Dockerfile . 

docker build \
--build-arg ROOT_PASSWORD=$ROOT_PASSWORD \
--build-arg PASSWORD=$PASSWORD \
--build-arg USER=$MARIADB_USER \
-t $MARIADB_IMAGE -f ./dockerfiles/mariadb/Dockerfile .

docker run --detach --network $NETWORK --name $MARIADB_CONTAINER $MARIADB_IMAGE

#If needed you can setup a volume with
# -v "PATH":/var/www/html
docker run -d -p 80:80 --network $NETWORK --name $WEBSERVER_CONTAINER $PHPAPACHE_IMAGE


