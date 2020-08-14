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
