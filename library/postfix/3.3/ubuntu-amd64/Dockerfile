FROM antonchernik/ubuntu:18.04.4-amd64

RUN \
  apt-get update && \
  DEBIAN_FRONTEND=noninteractive \
    apt-get -y install \
      supervisor \
      syslog-ng \
      postfix \
      mailutils \
      --no-install-recommends \
  && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/*

RUN postconf -e mail_spool_directory="/var/spool/mail/"
RUN postconf -e mailbox_command=""
RUN postconf -e inet_protocols="ipv4"
RUN postconf -e mynetworks="127.0.0.0/8 172.16.238.0/24 [::ffff:127.0.0.0]/104 [::1]/128"
RUN postconf -e always_add_missing_headers="yes"

RUN echo 'SYSLOGNG_OPTS="--no-caps"' >> /etc/default/syslog-ng

ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 25

CMD ["/usr/bin/supervisord"]