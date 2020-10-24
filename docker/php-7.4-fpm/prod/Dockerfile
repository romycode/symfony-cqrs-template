FROM php:7.4-fpm-alpine

USER root

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
    && docker-php-ext-configure intl                    \
    && docker-php-ext-install -j$(nproc)                \
       zip                                              \
       intl                                             \
       pgsql                                            \
       pdo_pgsql                                        \
    && curl -sO https://gordalina.github.io/cachetool/downloads/cachetool.phar  \
    && chmod a+x cachetool.phar                                                 \
    && mv cachetool.phar /usr/local/bin/cachetool                               \
    && curl -sS https://getcomposer.org/installer                   \
       | php -- --install-dir=/usr/local/bin --filename=composer    \
    && composer global require "hirak/prestissimo"                  \

RUN mkdir -p var/cache var/logs vendor
COPY bin bin
COPY config config
COPY public public
COPY src src
COPY composer.json composer.json
COPY composer.lock composer.lock
COPY symfony.lock symfony.lock
COPY .env.production .env

RUN composer install --no-dev --optimize-autoloader
RUN php bin/console cache:clear --env=prod

COPY ./docker/php-7.4-fpm/prod/rootfs /
WORKDIR /opt/app
RUN chown -R www-data:www-data /opt/app
USER www-data