#!/usr/bin/env bash

#================define methods================
# commons
# Print error messges eg:  _err "This is error"
function _err()
{
    echo -e "\033[1;31m[ERROR NO OK] $@\033[0m"
}
export -f _err

# Print notice messages eg: _info "This is Info"
function _info()
{
    echo -e "\033[1;32m$@\033[0m" >&1
}
export -f _info

# Print tips messages eg: _tips "This is Tips"
function _tips()
{
    echo -e "\033[1;33m[TIPS] $@\033[0m"
}
export -f _tips

function get_local_ip()
{
    LOCAL_IP=$(/sbin/ip route | egrep 'src 172\.|src 10\.|src 100\.|src 192\.' | awk '{print $NF}' | head -n 1)
    echo "${LOCAL_IP}"
}
export -f get_local_ip

# init deploy conf
function export_deploy_conf()
{
    local local_ip=$(get_local_ip)
    local deploy_file=/data/deployConf/${local_ip}.conf

    if [ ! -f ${deploy_file} ]; then
        _err "The deploy configuration file does not exist!"
        exit 1
    fi
    source ${deploy_file}

    local vars=$(grep -v "^#" ${deploy_file} | grep -v '^$'  | cut -d= -f1)

    for key in ${vars[@]}
    do
        if [ "${key:0:1}" = "#" ]; then
            continue
        fi
        eval value=\$${key}
        echo ${key}="${value}"
    done


    export ${vars}
#    echo ${vars}
}
export -f export_deploy_conf

#export_deploy_conf