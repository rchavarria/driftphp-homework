#!/bin/bash

echo "=> Should get 404, user not found"
curl -s http://localhost:8000/users/cgrj
echo "" && sleep 1

echo "=> Save a user"
curl -s -XPUT -H "Content-Type: application/json" http://localhost:8000/users/cgrj -d'{"name":"Senor Cangrejo"}'
echo "" && sleep 1

echo "=> Get saved user"
curl -s http://localhost:8000/users/cgrj
echo "" && sleep 1

echo "=> Delete it"
curl -s -XDELETE http://localhost:8000/users/cgrj
echo "" && sleep 1

echo "=> Should get 404 again"
curl -s http://localhost:8000/users/cgrj
echo "" && sleep 1
