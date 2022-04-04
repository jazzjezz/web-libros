# web-libros

Proyecto escolar. Página web con autenticación. Está conectada mediante dos contenedores Docker; un servidor php 8.1 y un servidor de base de datos mariadb.

## Table of contents
* [General-info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General info
So this project uses custom Docker images to run. 
The build script creates the necessary images, containers and configurations necessary to run this project.

## Technologies
This project uses
* Docker
** Custom Dockerfile of the image php:apache to run the web server
** Custom Dockerfile of the image mariadb:lastes to setup a relational database
* openssl to create random passwords (You can change this in the build script)
* PHP 8.1, CSS, HTML5

## Setup
To run this project you can clone this repo and execute the script 
```
$ docker-build.sh
```
After you can simply go to localhost:80