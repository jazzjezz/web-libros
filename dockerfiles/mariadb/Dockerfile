#imagen para base de datos no relacional con MariaDB
FROM mariadb:latest
MAINTAINER jazzjezz jazzjezz@disroot.org

ARG ROOT_PASSWORD
ARG PASSWORD
ARG USER
ENV MARIADB_DATABASE=${USER}
ENV MARIADB_USER=${USER}
ENV MARIADB_ROOT_PASSWORD=${ROOT_PASSWORD}
ENV MARIADB_PASSWORD=${PASSWORD}
ENV MARIADB_ROOT_HOST=localhost

#instalación de los objetos en base de datos
COPY install/dbobjects/init.sql /docker-entrypoint-initdb.d/