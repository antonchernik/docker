# PHP FPM
[![](https://images.microbadger.com/badges/image/antonchernik/php-fpm-xdebug.svg)](https://microbadger.com/images/antonchernik/php-fpm-xdebug)
[![](https://images.microbadger.com/badges/version/antonchernik/php-fpm-xdebug.svg)](https://microbadger.com/images/antonchernik/php-fpm-xdebug)
### How to use this image
### File docker-compose.yml example
<pre>
version: "2.1"
services:
  php-fpm:
    container_name: php-fpm
    image: antonchernik/php-fpm-xdebug:7.4.3-ubuntu-amd64
    ports:
    - "9000:9000"
    volumes:
      - ./:/var/www/html
      - ./etc/php/conf.d/php-dev.ini:/usr/local/etc/php/conf.d/php-dev.ini
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
### File php-dev.ini example
<pre>
xdebug.remote_autostart=off
xdebug.remote_connect_back=0
xdebug.remote_handler=dbgp
xdebug.profiler_enable=0
xdebug.remote_host="docker.for.win.host.internal"
xdebug.remote_log = "/var/log/xdebug.log"
xdebug.remote_enable=1
xdebug.remote_port=9001
memory_limit = -1
</pre>
### Run with command:
> docker-compose up -d
### Stop with command:
> docker-compose down
### Build with:
* libgearman-dev
* git
* unzip
* xdebug
* Gearman PECL extension
* Redis PECL extension
* Memcached PECL extension

### Supported tags and respective Dockerfile links
<br />