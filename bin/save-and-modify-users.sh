#!/bin/bash

curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/bob -d'{"name":"Sponge Bob"}'
echo "" && sleep 1

curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/cgrj -d'{"name":"Deberia ser el Senor Cangrejo"}'
echo "" && sleep 1

# fix previous user's name
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/cgrj -d'{"name":"Senor Cangrejo"}'
echo "" && sleep 1

curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/ptrc -d'{"name":"Patricio Estrella"}'
echo "" && sleep 1

# fix Bob's name in Spanish
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/bob -d'{"name":"Bob Esponja"}'
echo "" && sleep 1
