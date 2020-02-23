FROM antonchernik/ubuntu:latest

RUN \
  apt-get update && \
  DEBIAN_FRONTEND=noninteractive \
    apt-get -y install \
      gearman \
  && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/*

EXPOSE 4730

CMD ["gearmand"]