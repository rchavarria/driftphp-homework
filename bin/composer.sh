#!/bin/bash

#
# `-v /$PWD:/var/www` works fine on GitBash
# Modify and adapt if you run this script from another shell
# `-v /c/Project/driftphp-project:/var/www` might work in PowerShell
#

docker run \
    --rm \
    -p 8000:8000 \
    -v /$PWD:/var/www \
    driftphp/base \
    composer update
