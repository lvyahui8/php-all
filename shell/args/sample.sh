#!/usr/bin/env bash

if [ $# -gt 0 ] && [ "$1" = "nostart" ]; then
    echo "nostart"
    exit 0
fi

echo "start"