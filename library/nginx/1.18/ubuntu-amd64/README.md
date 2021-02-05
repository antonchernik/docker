# Nginx
[![](https://images.microbadger.com/badges/image/antonchernik/nginx.svg)](https://microbadger.com/images/antonchernik/nginx)
[![](https://images.microbadger.com/badges/version/antonchernik/nginx.svg)](https://microbadger.com/images/antonchernik/nginx)
### How to use this image
### File docker-compose.yml example
<pre>
version: "2.1"
services:
  nginx:
    container_name: nginx
    image: antonchernik/nginx:1.14-ubuntu-amd64
    ports:
    - "80:80"
    - "443:443"
    restart: always
    hostname: domain
    domainname: domain.localhost
    volumes:
      - ./:/var/www/html
      - ./etc/nginx/sites-enabled/domain.localhost.conf:/etc/nginx/conf.d/domain.localhost.conf
      - ./var/log/nginx:/var/log/nginx
    networks:
      app_net:
        ipv4_address: 172.1.1.2
networks:
  app_net:
    driver: bridge
    enable_ipv6: false
    ipam:
      driver: default
      config:
      - subnet: 172.1.1.0/24
</pre>
### File domain.localhost.conf example
<pre>

log_format trace escape=json
                   '{'
                     '"time_local":"$time_local",'
                     '"remote_addr":"$remote_addr",'
                     '"remote_user":"$remote_user",'
                     '"request":"$request",'
                     '"status":"$status",'
                     '"body_bytes_sent":"$body_bytes_sent",'
                     '"request_time":"$request_time",'
                     '"http_referrer":"$http_referer",'
                     '"http_user_agent":"$http_user_agent",'
                     '"request_id":"nginx-$request_id",'
                     '"request_time":"$request_time",'
                     '"upstream_connect_time":"$upstream_connect_time",'
                     '"upstream_header_time":"$upstream_header_time",'
                     '"upstream_response_time":"$upstream_response_time"'
                   '}';

upstream php-fpm {
    server 172.1.1.3:9000;
}
server {
    listen 80;
    server_name  domain.localhost localhost;
    sendfile off;
    server_tokens off;
    charset utf-8;
    client_max_body_size   1M;
    client_header_timeout  5;
    client_body_timeout    5;
    send_timeout           5;
    root /var/www/html/public;
    error_log /var/log/nginx/domain.localhost.error.log;
    access_log  /var/log/nginx/domain.localhost.access.log trace;
    add_header X-Request-ID nginx-$request_id;
    location = /favicon.ico { access_log off; log_not_found off; }
    location / {
        try_files $uri /index.php?$args;
    }
    error_page   500 502 503 504  /50x.html;
    location = /50x.html {
        root   /usr/share/nginx/html;
    }
    location ~ \.php$ {
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass php-fpm;
        fastcgi_index index.php;
        fastcgi_read_timeout 30;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_param X_HTTP_REQUEST_ID nginx-$request_id;
    }
}
</pre>
### Run with command:
> docker-compose up -d
### Stop with command:
> docker-compose down
### Supported tags and respective Dockerfile links
<br/>* 1.18.0 Dockerfile [(library/nginx/1.18/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/nginx-1.18.0-ubuntu-amd64/library/nginx/1.18/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/nginx/1.18/ubuntu-amd64/trivy.json)](https://github.com/antonchernik/docker/blob/nginx-1.18.0-ubuntu-amd64/library/nginx/1.18/ubuntu-amd64/trivy.json)<br />* 1.18.0 Dockerfile [(library/nginx/1.18/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/nginx-1.18.0-ubuntu-amd64/library/nginx/1.18/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/nginx/1.18/ubuntu-amd64/trivy.json)](https://github.com/antonchernik/docker/blob/nginx-1.18.0-ubuntu-amd64/library/nginx/1.18/ubuntu-amd64/trivy.json)<br />* 1.18.0 Dockerfile [(library/nginx/1.18/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/nginx-1.18.0-ubuntu-amd64/library/nginx/1.18/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/nginx/1.18/ubuntu-amd64/trivy.json)](https://github.com/antonchernik/docker/blob/nginx-1.18.0-ubuntu-amd64/library/nginx/1.18/ubuntu-amd64/trivy.json)<br />* 1.18.0 Dockerfile [(library/nginx/1.18/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/nginx-1.18.0-ubuntu-amd64/library/nginx/1.18/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/nginx/1.18/ubuntu-amd64/trivy.json)](https://github.com/antonchernik/docker/blob/nginx-1.18.0-ubuntu-amd64/library/nginx/1.18/ubuntu-amd64/trivy.json)<br />* 1.18-ubuntu-amd64 Dockerfile [(library/nginx/1.18/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/nginx-v1.18/library/nginx/1.18/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/nginx/1.18/ubuntu-amd64/trivy.txt)](https://github.com/antonchernik/docker/blob/nginx-v1.18/library/nginx/1.18/ubuntu-amd64/trivy.txt)<br />* 1.14-ubuntu-amd64 Dockerfile [(library/nginx/1.14/ubuntu-amd64/Dockerfile)](https://github.com/antonchernik/docker/blob/nginx-v1.14/library/nginx/1.14/ubuntu-amd64/Dockerfile)<br />Trivy security report [(library/nginx/1.14/ubuntu-amd64/trivy.txt)](https://github.com/antonchernik/docker/blob/nginx-v1.14/library/nginx/1.14/ubuntu-amd64/trivy.txt)<br />