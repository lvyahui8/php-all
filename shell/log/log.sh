#!/usr/bin/env bash


log_path=/tmp/
mkdir -p ${log_path}
date_time=`date +"%Y%m%d"`
log_file=${log_path}/keepalived-${date_time}.log
touch ${log_file}


function log() {
    local message="$1"
    local ctime=`date +"%Y-%m-%d %H:%M:%S"`
    #echo "[$ctime] $message"
    printf "[ %s ] [ %5d ] %s\n" "$ctime" $$ "$message"
}

function log2file(){
    local message="$1"
    local ctime=`date +"%Y-%m-%d %H:%M:%S"`
    #echo "[$ctime] $message" | tee -a "$log_file"
    printf "[ %s ] [ %5d ] %s\n" "$ctime" $$ "$message" | tee -a "$log_file"
}

log "lvyahui"
log2file "hello \n world!"