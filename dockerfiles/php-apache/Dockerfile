FROM php:apache
MAINTAINER jazzjezz jazzjezz@disroot.org

ARG DB_HOSTNAME
ARG DB_USERNAME
ARG DB_PASSWORD
ENV DB_HOSTNAME=${DB_HOSTNAME}
ENV DB_USERNAME=${DB_USERNAME}
ENV DB_PASSWORD=${DB_PASSWORD}

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions mysqli