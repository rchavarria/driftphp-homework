#!/bin/bash

curl -s -XDELETE http://localhost:8000/users/bob
echo "" && sleep 1

curl -s -XDELETE http://localhost:8000/users/cgrj
echo "" && sleep 1

curl -s -XDELETE http://localhost:8000/users/clmrd
echo "" && sleep 1

curl -s -XDELETE http://localhost:8000/users/arnt
echo "" && sleep 1

curl -s -XDELETE http://localhost:8000/users/ptrc
echo "" && sleep 1
