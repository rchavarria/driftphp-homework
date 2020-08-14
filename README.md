# Cómo ejecutar el proyecto

# Deberes del curso sobre DriftPHP, CQRS y Event sourcing

## Cómo ejecutar el proyecto

### Instalar dependencias

`composer install` o `composer update`

Hay un script, `bin/composer.sh` que te ayuda si ejecutas todo en contenedores docker.

### Infrastructura

Levantar la infraestructura:

```
docker-compose -f docker/docker-compose-infra.yml up
```

Es necesario crear el *exchange* de RabbitMQ a mano, lo siento.

Pararla:

```
docker-compose -f docker/docker-compose-infra.yml up
```

### Servidores

De forma similar a la infraestructura:

Levantar los server:

```
docker-compose -f docker/docker-compose-servers.yml up
```

Pararlos:

```
docker-compose -f docker/docker-compose-servers.yml up
```
