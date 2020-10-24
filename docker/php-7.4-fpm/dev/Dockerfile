FROM php:7.4-fpm-alpine

ARG XDEBUG_VERSION=2.9.3
ARG HOST_IP

RUN apk -U update                                       \
    && apk add --quiet --no-cache                       \
                            curl                        \
                            postgresql-dev              \
                            postgresql-client           \
                            composer                    \
                            autoconf                    \
                            zlib-dev                    \
                            libsodium-dev               \
                            libzip-dev                  \
                            gcc                         \
                            g++                         \
                            make                        \
                            git                         \
                            bash                        \
    && docker-php-ext-configure intl                    \
    && docker-php-ext-install -j$(nproc)                \
       zip                                              \
       intl                                             \
       pgsql                                            \
       pdo_pgsql                                        \
    && curl -sS https://getcomposer.org/installer |     \
       php -- --install-dir=/usr/local/bin --filename=composer      \
    && pecl install xdebug-${XDEBUG_VERSION};                       \
       docker-php-ext-enable xdebug                                 \
    && echo "xdebug.remote_host=$HOST_IP" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY ./docker/php-7.4-fpm/dev/rootfs            /
COPY ./docker/php-7.4-fpm/dev/init.sh           /usr/local/bin/init.sh
COPY ./docker/php-7.4-fpm/dev/wait-for-it.sh    /usr/local/bin/wait-for-it.sh

RUN mkdir -p /opt/app/var/cache /opt/app/var/log

WORKDIR /opt/app
