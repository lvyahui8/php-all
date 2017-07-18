#!/usr/bin/env bash

IFS=','
read -r -a servers <<< "127.0.0.1,192.168.0.1 backup,192.168.0.10"
touch tmp.conf
for real_server in "${servers[@]}"
do
    if [ ! -z ${real_server} ]; then
        echo "real_server: ${real_server}"
        sed -i  "/$real_server/d" tmp.conf
        sed  -i "/real_server_item/i\server $real_server;" tmp.conf
    fi
done