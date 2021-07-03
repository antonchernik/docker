FROM antonchernik/php-cli-base:8.0.8-ubuntu-amd64

RUN composer global require \
        phpmd/phpmd=@stable \
        squizlabs/php_codesniffer=@stable \
        sebastian/phpcpd \
        phpstan/phpstan \
        phpstan/phpstan-doctrine \
        phpstan/phpstan-phpunit \
        phpstan/phpstan-symfony \
    && /home/app/vendor/bin/phpcs --config-set ignore_warnings_on_exit 1

ADD files /home/app

CMD ["/bin/bash"]