#!/usr/bin/env bash

doc_path=$(cd $(dirname "$0") && pwd)

. "$doc_path/../log/log.sh" /data/log/nginx daemon


nginx_proccess=$(ps axu | grep nginx | grep "master process" | wc -l)
nginx_ss_cnt=$(netstat -nat | wc -l)
nginx_listen=$(netstat -ntlp | grep nginx | wc -l)

if [ ${nginx_proccess} -gt 0 ] && [ ${nginx_ss_cnt} -gt 0 ] && [ ${nginx_listen} -gt 0 ]; then
    log "nginx running"
    exit 0
else
    log2file "nginx has exception. try restart nginx"
    onginx
    exit 1
fi

