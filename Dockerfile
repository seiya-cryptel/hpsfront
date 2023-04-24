FROM almalinux/9-base
COPY ./files/epel-release-latest-9.noarch.rpm /root/
COPY ./files/epel-next-release-latest-9.noarch.rpm /root/
COPY ./files/remi-release-9.rpm /root/
COPY ./files/perl-Excel-Writer-XLSX-0.84-1.el9.noarch.rpm /root/
RUN ulimit -n 1024 && \
    dnf install yum-utils -y && \
    yum -y install /root/epel-release-latest-9.noarch.rpm /root/epel-next-release-latest-9.noarch.rpm /root/remi-release-9.rpm /root/perl-Excel-Writer-XLSX-0.84-1.el9.noarch.rpm
RUN ulimit -n 1024 && \
    dnf module enable php:remi-8.2 -y && \
    yum -y install procps-ng postfix rsyslog httpd php-cli php-gd php-pecl-zip php-pdo php-pecl-mcrypt php-imap php-mbstring php-common php php-mysqlnd php-xml perl-LWP-Protocol-https perl-Excel-Writer-XLSX && \
    mv /etc/httpd/conf.d/welcome.conf /etc/httpd/conf.d/welcome.conf.org && \
    sed -i "s/AllowOverride None/AllowOverride All/g" /etc/httpd/conf/httpd.conf && \
    sed -i "s/DocumentRoot \"\/var\/www\/html\"/DocumentRoot \"\/var\/www\/html\/hpsfront\/public\"/g" /etc/httpd/conf/httpd.conf && \
    sed -i "s/ServerAdmin root\@localhost/ServerAdmin webmaster\@midori-anzen.com/g" /etc/httpd/conf/httpd.conf && \
    sed -i -e "s|expose_php = On|expose_php = Off|" /etc/php.ini && \
    sed -i -e "s|;date.timezone =|date.timezone = Asia/Tokyo|" /etc/php.ini && \
    sed -i -e "s|post_max_size = 8M|post_max_size = 64M|" /etc//php.ini && \
    sed -i -e "s|upload_max_filesize = 2M|upload_max_filesize = 50M|" /etc/php.ini && \
    sed -i -e "s|inet_protocols = all|inet_protocols = ipv4|" /etc/postfix/main.cf
RUN ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime
RUN mkdir /data
RUN echo "NETWORKING=yes" > /etc/sysconfig/network
RUN sed -i "s/#LoadModule mpm_prefork_module/LoadModule mpm_prefork_module/g" /etc/httpd/conf.modules.d/00-mpm.conf && \
    sed -i "s/LoadModule mpm_event_module/#LoadModule mpm_event_module/g" /etc/httpd/conf.modules.d/00-mpm.conf

# rsyslog設定
RUN sed -i -e 's#/var/log/maillog#/var/log/postfix/maillog#g' \
           -e 's/SysSock.Use="off"/SysSock.Use="on"/g' \
           -e 's/^\(module(load="imjournal"\)/#\1/g'  \
           -e 's/^\([ ]*StateFile="imjournal.state\)"/#\1/g' /etc/rsyslog.conf
#RUN sed -i -e "s|\$SystemLogSocketName|#\$SystemLogSocketName|" /etc/rsyslog.d/listen.conf && \
RUN sed -i -e "s|\$ModLoad imjournal|#\$ModLoad imjournal|" /etc/rsyslog.conf && \
    sed -i -e "s|\$IMJournalStateFile|#\$IMJournalStateFile|" /etc/rsyslog.conf && \
    sed -i -e "s|\$OmitLocalLogging on|\$OmitLocalLogging off|" /etc/rsyslog.conf && \
    sed -i -e "s|\/var\/log\/postfix|\/var\/log|" /etc/rsyslog.conf

# Postfix設定
RUN mkdir /var/log/postfix && \
    sed -i -e "s|inet_protocols = all|inet_protocols = ipv4|" /etc/postfix/main.cf

COPY ./files/startup.sh ./
RUN chmod +x /startup.sh

# Apache実行
#CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
CMD ["/startup.sh"]
