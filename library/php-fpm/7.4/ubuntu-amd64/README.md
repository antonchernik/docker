# PHP FPM
[![](https://images.microbadger.com/badges/image/antonchernik/php-fpm.svg)](https://microbadger.com/images/antonchernik/php-fpm)
[![](https://images.microbadger.com/badges/version/antonchernik/php-fpm.svg)](https://microbadger.com/images/antonchernik/php-fpm)
### How to use this image
### File docker-compose.yml example
<pre>
version: "2.1"
services:
  php-fpm:
    container_name: php-fpm
    image: antonchernik/php-fpm:7.4.3-ubuntu-amd64
    ports:
    - "9000:9000"
    volumes:
      - ./:/var/www/html
      - ./etc/php/php-fpm.d/zz-docker.conf:/usr/local/etc/php-fpm.d/zz-docker.conf
    networks:
      app_net:
        ipv4_address: 172.1.1.3
networks:
  app_net:
    driver: bridge
    enable_ipv6: false
    ipam:
      driver: default
      config:
      - subnet: 172.1.1.0/24
</pre>
### File zz-docker.conf example
<pre>
[global]
daemonize = no
[www]
listen = 0.0.0.0:9000
</pre>
### Run with command:
> docker-compose up -d
### Stop with command:
> docker-compose down
### Supported tags and respective Dockerfile links
<br/>* 7.4.14 Dockerfile [(library/php-fpm/7.4/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/php-fpm-7.4.14-ubuntu-amd64/library/php-fpm/7.4/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/php-fpm/7.4/ubuntu-amd64/trivy.json)](https://github.com/antonchernik/docker/blob/php-fpm-7.4.14-ubuntu-amd64/library/php-fpm/7.4/ubuntu-amd64/trivy.json)<br />* 7.4.13 Dockerfile [(library/php-fpm/7.4/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/php-fpm-7.4.13-ubuntu-amd64/library/php-fpm/7.4/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/php-fpm/7.4/ubuntu-amd64/trivy.json)](https://github.com/antonchernik/docker/blob/php-fpm-7.4.13-ubuntu-amd64/library/php-fpm/7.4/ubuntu-amd64/trivy.json)<br />* 7.4.9-ubuntu-amd64 Dockerfile [(library/php-fpm/7.4/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/php-fpm-v7.4.9/library/php-fpm/7.4/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/php-fpm/7.4/ubuntu-amd64/trivy.txt)](https://github.com/antonchernik/docker/blob/php-fpm-v7.4.9/library/php-fpm/7.4/ubuntu-amd64/trivy.txt)<br />* 7.4.7-ubuntu-amd64 Dockerfile [(library/php-fpm/7.4/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/php-fpm-v7.4.7/library/php-fpm/7.4/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/php-fpm/7.4/ubuntu-amd64/trivy.txt)](https://github.com/antonchernik/docker/blob/php-fpm-v7.4.7/library/php-fpm/7.4/ubuntu-amd64/trivy.txt)<br />* 7.4.5-ubuntu-amd64 Dockerfile [(library/php-fpm/7.4/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/php-fpm-v7.4.5/library/php-fpm/7.4/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/php-fpm/7.4/ubuntu-amd64/trivy.txt)](https://github.com/antonchernik/docker/blob/php-fpm-v7.4.5/library/php-fpm/7.4/ubuntu-amd64/trivy.txt)<br />* 7.4.3-ubuntu-amd64 Dockerfile [(library/php-fpm/7.4/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/php-fpm-v7.4.3/library/php-fpm/7.4/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/php-fpm/7.4/ubuntu-amd64/trivy.txt)](https://github.com/antonchernik/docker/blob/php-fpm-v7.4.3/library/php-fpm/7.4/ubuntu-amd64/trivy.txt)<br />