#!/usr/bin/env bash

# usage
# ./scan_path.sh [command] [path]
# command   default ls
# path      deafult .

path=$1
if !path; then
    path=.
fi

for $file in 'ls -a '; do
    if test -f $file
    then
        echo $file;
    fi
done