#!/bin/bash

#
# `-v /$PWD:/var/www` works fine on GitBash
# Modify and adapt if you run this script from another shell
# `-v /c/Project/driftphp-project:/var/www` might work in PowerShell
#

docker run \
    --rm \
    -p 1234:1234 \
    -v /$PWD:/var/www \
    --name server-wbs \
    driftphp/base \
    php bin/console websocket:run localhost:1234 --route events --exchange my_events
