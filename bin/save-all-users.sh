#!/bin/bash

curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/bob -d'{"name":"Bob Esponja"}'
echo "" && sleep 1

curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/cgrj -d'{"name":"Senor Cangrejo"}'
echo "" && sleep 1

curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/clmrd -d'{"name":"Calmardo Tentaculos"}'
echo "" && sleep 1

curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/arnt -d'{"name":"Arenita Mejillas"}'
echo "" && sleep 1

curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/ptrc -d'{"name":"Patricio Estrella"}'
echo "" && sleep 1
