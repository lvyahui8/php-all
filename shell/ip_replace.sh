#!/bin/bash
export HOST_IP=127.0.0.1
export DEPLOY_ENV=qcloud
export CUR_PATH=$(dirname $(which $0))

ip_regex="((?:(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d)))\.){3}(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d))))"
sed -i "s:${ip_regex}:${HOST_IP}:g"
./ip_script.sh