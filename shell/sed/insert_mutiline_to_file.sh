#!/usr/bin/env bash

CUR_PATH=$(dirname $0)
CUR_PATH=${CUR_PATH/\./$(pwd)}
cd ${CUR_PATH}

# 方法一
## conf="server-id=`date +%s`\nlog-bin=mysql-bin\nreplicate-wild-ignore-table=mysql.%\nreplicate-wild-ignore-table=information_schema.%\nreplicate-wild-ignore-table=performance_schema.%\n"
##
## echo -e ${conf} > tmp.conf
## #mysqld_line=$(awk '/\[mysqld\]/ {print NR}' my.cnf)
## # insert config
## sed -i '/\[mysqld\]/r tmp.conf' my.cnf
## rm -f my.cnf

# 方法二
sed -i "/^$/d" mutiline.conf
echo '' >> mutiline.conf

sed  -e  "/\[mysqld\]/a\server-id=`date +%s`" -e '/\[mysqld\]/r mutiline.conf' my.cnf