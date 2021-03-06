FROM antonchernik/php-apache:7.4.19-ubuntu-amd64

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install  -y \
        libgearman-dev \
        git \
        unzip \
    --no-install-recommends

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /tmp
ENV COMPOSER_VERSION 2.0.8

RUN set -eux; \
  curl --silent --fail --location --retry 3 --output /tmp/installer.php --url https://raw.githubusercontent.com/composer/getcomposer.org/cb19f2aa3aeaa2006c0cd69a7ef011eb31463067/web/installer; \
  php -r " \
    \$signature = '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5'; \
    \$hash = hash('sha384', file_get_contents('/tmp/installer.php')); \
    if (!hash_equals(\$signature, \$hash)) { \
      unlink('/tmp/installer.php'); \
      echo 'Integrity check failed, installer is either corrupt or worse.' . PHP_EOL; \
      exit(1); \
    }"; \
  php /tmp/installer.php --no-ansi --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION}; \
  composer --ansi --version --no-interaction; \
  rm -f /tmp/installer.php; \
  find /tmp -type d -exec chmod -v 1777 {} +

RUN pecl install xdebug-2.9.8 \
	&& docker-php-ext-enable xdebug

RUN pecl install swoole-4.5.9 \
	&& docker-php-ext-enable swoole

RUN \
    cd /tmp && \
    git clone https://github.com/php/pecl-networking-gearman.git && \
    cd pecl-networking-gearman && \
    phpize && \
    ./configure && \
    make && make install && \
    rm -rf /tmp/pecl-gearman && \
    docker-php-ext-enable gearman

RUN pecl install redis-5.3.2 && \
    docker-php-ext-enable redis

RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev \
    && pecl install memcached-3.1.5 \
    && docker-php-ext-enable memcached

RUN apt-get update && apt-get install -y librabbitmq-dev libssh-dev \
    && pecl install amqp-1.10.2 \
    && docker-php-ext-enable amqp

RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

#RUN curl -OL http://get.sensiolabs.org/security-checker.phar \
#    && chmod +x security-checker.phar \
#    && mv security-checker.phar /usr/local/bin/security-checker

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

RUN apt-get install -y libpq-dev \
       && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
       && docker-php-ext-install pdo pgsql pdo_pgsql \
       && docker-php-ext-enable pdo pgsql pdo_pgsql
