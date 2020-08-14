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

### Creación de tablas y exchanges

No hace falta crear la base de datos ni la tabla en MySQL, docker-compose lo hace por
nosotros. Si necesitas crearlas, mira el script SQL `docker/sql/users.sql`.

Para crear el exchange se puede ejecutar el comando

```
php bin/console event-bus:infra:create --exchange my_events --force --env=prod
```

O el script `bin/create-exchange.sh` si se quiere utilizar Docker para ello

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
