#!/usr/bin/env bash

CUR_PATH=$(dirname $0)
CUR_PATH=${CUR_PATH/\./$(pwd)}
cd ${CUR_PATH}

. commons.sh

_info 'hello'

export_deploy_conf


echo $SERVICE_HOSTS