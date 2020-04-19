FROM antonchernik/php-fpm:7.4.5-ubuntu-amd64

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install  -y \
        libgearman-dev \
        git \
        unzip \
    --no-install-recommends


RUN pecl install xdebug-2.9.4 \
	&& docker-php-ext-enable xdebug

RUN \
    cd /tmp && \
    git clone https://github.com/php/pecl-networking-gearman.git && \
    cd pecl-networking-gearman && \
    phpize && \
    ./configure && \
    make && make install && \
    rm -rf /tmp/pecl-gearman && \
    docker-php-ext-enable gearman

RUN pecl install redis-5.2.1 && \
    docker-php-ext-enable redis

RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev \
    && pecl install memcached-3.1.5 \
    && docker-php-ext-enable memcached

RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN curl -OL http://get.sensiolabs.org/security-checker.phar \
    && chmod +x security-checker.phar \
    && mv security-checker.phar /usr/local/bin/security-checker

RUN curl -OL https://phar.phpunit.de/phpunit-9.phar \
    && chmod +x phpunit-9.phar \
    && mv phpunit-9.phar /usr/local/bin/phpunit

RUN curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar \
    && chmod +x phpcs.phar \
    && mv phpcs.phar /usr/local/bin/phpcs

RUN curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar \
    && chmod +x phpcbf.phar \
    && mv phpcbf.phar /usr/local/bin/phpcbf

RUN curl -OL https://phpmd.org/static/latest/phpmd.phar \
    && chmod +x phpmd.phar \
    && mv phpmd.phar /usr/local/bin/phpmd

RUN curl -OL https://phar.phpunit.de/phpcpd.phar \
    && chmod +x phpcpd.phar \
    && mv phpcpd.phar /usr/local/bin/phpcpd
