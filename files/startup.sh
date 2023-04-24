#!/bin/bash

/usr/sbin/rsyslogd
/usr/sbin/postfix start
/usr/sbin/httpd -D FOREGROUND
