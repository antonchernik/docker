FROM antonchernik/images:php-cli-base-8.0.6-ubuntu-amd64

ENV APP_RUN_SERVER=yes \
    APP_ENV=prod \
    APP_PORT=8080 \
    APP_DEBUG=no \
    APP_XDEBUG=no

RUN pecl install swoole-4.6.7 \
    && docker-php-ext-enable swoole

COPY conf.d /usr/local/etc/php/conf.d

COPY ./docker-php-entrypoint /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-php-entrypoint