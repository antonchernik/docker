FROM antonchernik/php-fpm:7.4.3-ubuntu-amd64

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install  -y \
        libgearman-dev \
        git \
        unzip \
    --no-install-recommends


RUN pecl install xdebug-2.9.2 \
	&& docker-php-ext-enable xdebug

RUN \
    cd /tmp && \
    git clone https://github.com/php/pecl-networking-gearman.git && \
    phpize && \
    ./configure && \
    make && make install && \
    rm -rf /tmp/pecl-gearman && \
    docker-php-ext-enable gearman

RUN pecl install redis-5.1.1 && \
    docker-php-ext-enable redis

RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev \
    && pecl install memcached-3.1.5 \
    && docker-php-ext-enable memcached

RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony