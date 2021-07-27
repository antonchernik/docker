# PHP CLI sanity check
[![](https://images.microbadger.com/badges/image/antonchernik/php-cli-sanity-check.svg)](https://microbadger.com/images/antonchernik/php-cli-sanity-check)
[![](https://images.microbadger.com/badges/version/antonchernik/php-cli-sanity-check.svg)](https://microbadger.com/images/antonchernik/php-cli-sanity-check)
### How to use this image
docker run --rm \
-v "$(pwd)"/project:/project \
-e BASE_PATH="/project" \
-e DIR_SRC="/project/src" \
-e STRICT_CHECKS="PHPCS,PHPSTAN,PHPCPD,PHPMD" \
-e PHPSTAN_LEVEL=5 \
antonchernik/php-cli-sanity-check:8.0.8-ubuntu-amd64 \
php /home/app/run.php
### Supported tags and respective Dockerfile links
<br/>