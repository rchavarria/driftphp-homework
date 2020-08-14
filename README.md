# TODO

- Cuando se conecte un cliente al WS reciba todos los usuarios en el sistema
en ese momento
- Cuando haya una petición de guardar un usuario que ya existe, en el cliente de
WS, buscar si ya existe y reemplazar ese elemento con el nuevo usuario

# Cómo ejecutar el proyecto

## Instalar dependencias

## Infrastructura

Levantar la infraestructura:

```
docker-compose -f docker/docker-compose-infra.yml up
```

Es necesario crear el *exchange* de RabbitMQ a mano, lo siento.

Pararla:

```
docker-compose -f docker/docker-compose-infra.yml up
```

## Servidores

De forma similar a la infraestructura:

Levantar los server:

```
docker-compose -f docker/docker-compose-servers.yml up
```

Pararlos:

```
docker-compose -f docker/docker-compose-servers.yml up
```
