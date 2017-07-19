#!/usr/bin/env bash

doc_path=$(cd $(dirname "$0") && pwd)

. "$doc_path/../log/log.sh" /data/log/mysql daemon


function mysql_check(){
    local listen=$(netstat -ntlp | grep mysqld | wc -l)
    local process=$(ps axu | grep mysqld | grep -v grep | grep -v mysqld_safe | wc -l)

    if [ ${listen} -gt 0 ] && [ ${process} -gt 0 ]; then
        local run_sql=$(mysql -h127.0.0.1 -uroot -proot -e "select 1 as result" 2>&1  | grep result | wc -l)
        if [ ${run_sql} -eq 0 ]; then
            log2file "run sql error"
            return 1
        fi
        return 0
    fi
    log2file "mysql proccess or listen error"
    return 1
}


#mysqld_pid=$(ps axu | grep mysqld | grep -v grep | grep -v mysqld_safe | awk '{print $2}')

#if [ ${mysqld_pid} == "" ]; then
#    systemctl restart maraidb
#else
#
#fi

mysql_check
if [ $? -gt 0 ]; then
    log2file "mysql has exception. try restart mysqld"
    systemctl restart maraidb
else
    log "mysql running"
fi