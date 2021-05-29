FROM antonchernik/php-cli:8.0.6-ubuntu-amd64
ARG GITHUB_API_TOKEN

ENV APP_NAME=${APP_NAME:-'no-name-defined'} \
    APP_ENV=prod \
    APP_DEBUG=no \
    APP_XDEBUG=no \
    APP_USER=app \
    OPCACHE_ENABLE=1 \
    OPCACHE_ENABLE_CLI=1 \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/home/app \
    COMPOSER_VERSION=2.0.8 \
    HOME=/home/app

COPY bin/init-container /usr/local/bin/init-container
COPY conf.d /usr/local/etc/php/conf.d

RUN set -eux; \
    useradd -ms /bin/bash app \
    && echo 'PS1="\[\033[36m\]\u\[\033[m\]@\[\033[32m\]${APP_NAME}:\[\033[33;1m\]\w\[\033[m\]\$ "' >> /home/app/.bashrc \
    && export PATH="/home/${APP_USER}/.composer/vendor/bin/:$PATH" \
    && apt-get update \
    && apt-get upgrade -y \
    && apt-get install  -y \
        git \
        unzip \
        libmemcached-dev \
        librabbitmq-dev \
        zlib1g-dev \
    --no-install-recommends; \
  curl --silent --fail --location --retry 3 --output /tmp/installer.php --url https://raw.githubusercontent.com/composer/getcomposer.org/master/web/installer; \
  php /tmp/installer.php --no-ansi --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION}; \
  composer --ansi --version --no-interaction; \
  composer selfupdate; \
  composer config -g github-oauth.github.com $GITHUB_API_TOKEN; \
  rm -f /tmp/installer.php; \
  find /tmp -type d -exec chmod -v 1777 {} + \
    && pecl install redis-5.3.2  \
    && docker-php-ext-enable redis \
    && pecl install memcached-3.1.5 \
    && docker-php-ext-enable memcached \
    && pecl install mongodb-1.9.0 \
    && docker-php-ext-enable mongodb \
    && pecl install xdebug-3.0.1 \
    && mkdir -p /opt/scripts/init \
    && chmod +x /usr/local/bin/init-container \
    && chown -R app:app /opt/scripts/init \
    && curl -OL https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh \
    && chmod +x wait-for-it.sh \
    && mv wait-for-it.sh /usr/local/bin/wait-for-it