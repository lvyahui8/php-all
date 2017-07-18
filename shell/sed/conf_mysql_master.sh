#!/usr/bin/env bash

cd /usr/local/services/mysql-1.0/conf
sed -i /server-id/d  my.cnf
sed -i /log-bin/d  my.cnf
sed -i /binlog-ignore-db/d  my.cnf
sed -i /replicate-wild-ignore-table/d  my.cnf
sed -i /auto-increment-increment/d  my.cnf
sed -i /auto-increment-offset/d  my.cnf
sed -i /slave-skip-errors/d  my.cnf
sed -i /binlog_format/d  my.cnf

conf="server-id=`date +%s`\nlog-bin=mysql-bin\nreplicate-wild-ignore-table=mysql.%\nreplicate-wild-ignore-table=information_schema.%\nreplicate-wild-ignore-table=performance_schema.%\nreplicate-wild-ignore-table=monitor_alert_statistic.%\nreplicate-wild-ignore-table=monitor_config.%\nreplicate-wild-ignore-table=monitor_data.%\nreplicate-wild-ignore-table=monitor_send_msg.%\nauto-increment-increment=2\nauto-increment-offset=1\nslave-skip-errors=all\nbinlog_format=ROW\n"

echo -e ${conf} > tmp.conf
#mysqld_line=$(awk '/\[mysqld\]/ {print NR}' my.cnf)
# insert config
sed -i '/\[mysqld\]/r tmp.conf' my.cnf
rm -f tmp.conf
#  service-uuid
rm -f /data/mysql/mysql/auto.cnf

# restart_mysql
# cd ../bin
# running_cnt=$(ps axu | grep 'mysqld' | grep bin |  grep -v grep | wc -l)
# if [ ${running_cnt} -gt 0 ]; then
#     _info "stop mysqld"
#     ./mysqladmin shutdown
# fi
# mkdir -p /data/log/mysql-1.0
# nohup ./mysqld_safe --defaults-file=../conf/my.cnf --ledir=/usr/local/services/mysql-1.0/bin/ &
