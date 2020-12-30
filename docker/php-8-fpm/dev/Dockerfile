FROM php:8-fpm-alpine

ARG XDEBUG_VERSION=3.0.1
ARG HOST_IP

RUN apk add --quiet --no-cache postgresql-dev   \
                               make             \
                               git              \
                               bash             \
	&& docker-php-ext-install pdo_pgsql         \
	&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
	&& php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
	&& php composer-setup.php --install-dir=/usr/local/bin --filename=composer   \
	&& php -r "unlink('composer-setup.php');"                   \
	&& apk add --no-cache --virtual .build-deps $PHPIZE_DEPS    \
    && pecl install xdebug-${XDEBUG_VERSION}                    \
    && docker-php-ext-enable xdebug                             \
    && apk del -f .build-deps

COPY ./docker/php-8-fpm/dev/rootfs            /
COPY ./docker/php-8-fpm/dev/init.sh           /usr/local/bin/init.sh
COPY ./docker/php-8-fpm/dev/wait-for-it.sh    /usr/local/bin/wait-for-it.sh

RUN mkdir -p /opt/app/var/cache /opt/app/var/log \
    && echo "xdebug.client_host=$HOST_IP" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /opt/app
