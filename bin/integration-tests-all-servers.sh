#!/bin/bash

echo "=> Save on server-8000"
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

echo "=> Get on server-8001 and server-8002"
curl -s http://localhost:8001/users/bob
echo "" && sleep 1
curl -s http://localhost:8002/users/cgrj
echo "" && sleep 1
curl -s http://localhost:8001/users/clmrd
echo "" && sleep 1
curl -s http://localhost:8002/users/arnt
echo "" && sleep 1

echo "=> Delete on three servers"
curl -s -XDELETE http://localhost:8000/users/bob
echo "" && sleep 1
curl -s -XDELETE http://localhost:8001/users/cgrj
echo "" && sleep 1
curl -s -XDELETE http://localhost:8002/users/clmrd
echo "" && sleep 1
curl -s -XDELETE http://localhost:8001/users/arnt
echo "" && sleep 1
curl -s -XDELETE http://localhost:8000/users/ptrc
echo "" && sleep 1

echo "=> Save on three servers"
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8002/users/bob -d'{"name":"Bob Esponja"}'
echo "" && sleep 1
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8001/users/cgrj -d'{"name":"Senor Cangrejo"}'
echo "" && sleep 1
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/clmrd -d'{"name":"Calmardo Tentaculos"}'
echo "" && sleep 1
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8001/users/arnt -d'{"name":"Arenita Mejillas"}'
echo "" && sleep 1
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8002/users/ptrc -d'{"name":"Patricio Estrella"}'
echo "" && sleep 1

echo "=> Update on three servers"
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8001/users/bob -d'{"name":"Bob Esponja (*)"}'
echo "" && sleep 1
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8002/users/cgrj -d'{"name":"Senor Cangrejo (*)"}'
echo "" && sleep 1
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/clmrd -d'{"name":"Calmardo Tentaculos (*)"}'
echo "" && sleep 1
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8002/users/arnt -d'{"name":"Arenita Mejillas (*)"}'
echo "" && sleep 1
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/ptrc -d'{"name":"Patricio Estrella (*)"}'
echo "" && sleep 1

echo "=> Get on three servers"
curl -s http://localhost:8001/users/bob
echo "" && sleep 1
curl -s http://localhost:8002/users/cgrj
echo "" && sleep 1
curl -s http://localhost:8001/users/clmrd
echo "" && sleep 1
curl -s http://localhost:8002/users/arnt
echo "" && sleep 1
curl -s http://localhost:8000/users/ptrc
echo "" && sleep 1

echo "=> Delete again on three servers"
curl -s -XDELETE http://localhost:8001/users/bob
echo "" && sleep 1
curl -s -XDELETE http://localhost:8002/users/cgrj
echo "" && sleep 1
curl -s -XDELETE http://localhost:8000/users/clmrd
echo "" && sleep 1
curl -s -XDELETE http://localhost:8001/users/arnt
echo "" && sleep 1
curl -s -XDELETE http://localhost:8002/users/ptrc
echo "" && sleep 1
