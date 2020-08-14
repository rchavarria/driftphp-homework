#!/bin/bash

#
# `-v /$PWD:/var/www` works fine on GitBash
# Modify and adapt if you run this script from another shell
# `-v /c/Project/driftphp-project:/var/www` might work in PowerShell
#

docker run \
    --rm \
    -p 8001:8000 \
    -v /$PWD:/var/www \
    --name server-8001 \
    driftphp/base \
    php vendor/bin/server watch 0.0.0.0:8000 --exchange my_events
