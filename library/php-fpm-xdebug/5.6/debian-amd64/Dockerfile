FROM antonchernik/php-fpm:5.6.40-ubuntu-amd64

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y pkg-config \
        libssl-dev \
        libmcrypt-dev \
        libmemcached-dev \
        zlib1g-dev \
        libmcrypt-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng12-dev \
        libicu-dev \
        libxml2-dev \
        git \
        unzip \
        wget \
        libmagickwand-dev \
        libgearman-dev \
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

RUN pecl install xdebug-2.5.5 \
	&& docker-php-ext-enable xdebug

RUN set -x\
    && docker-php-ext-install -j$(nproc) iconv intl xml soap mcrypt opcache pdo pdo_mysql mysqli mbstring \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && pear install -f Net_Gearman-0.2.3 \
    && pecl install memcached-2.2.0 \
    && docker-php-ext-enable memcached \
    && pecl install imagick \
	&& docker-php-ext-enable imagick \
	&& pecl install gearman \
    && docker-php-ext-enable gearman \
    && apt-get clean \
    && rm -r /var/lib/apt/lists/*
