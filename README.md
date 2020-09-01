# Deberes del curso sobre DriftPHP, CQRS y Event sourcing

## Cómo ejecutar el proyecto

1. Instalar dependencias
2. Levantar la infraestructura
3. Crear base de datos y tabla `users` en MySQL y exchange en RabbitMQ
4. Levantar servidores

### Instalar dependencias

`composer install` o `composer update`

Hay un script, `bin/composer.sh` que te ayuda si ejecutas todo en contenedores docker.

### Infrastructura

Levantar la infraestructura:

```
docker-compose -f docker/docker-compose-infra.yml up
```

Pararla:

```
docker-compose -f docker/docker-compose-infra.yml down
```

### Configuración de los servicios

Como la infraestructura (MySQL y RabbitMQ) y los servidores se ejecutan en docker-compose distintos, hay que utilizar
una dirección IP del *host*, del PC que ejecuta los contenedores.

Lo más seguro es que tengas que modificar `/Drift/config/services.yml`:

- `dbal/conections/main/host`
- `event_bus/async_adapter/amqp/host`

Si estas direcciones no están bien configuradas, tendremos errores de: no se puede conectar, time outs,...

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
docker-compose -f docker/docker-compose-servers.yml down
```

### Haciendo llamadas a los servers

Para ayudar a testear el código que estamos desarrollando, existen unos scripts
que hacen llamadas a los diferentes servidores, de forma que se automatiza la
creación/modificación/borrado de usuarios:

- `bin/integration-tests.sh`: prueba todas las peticiones al server (get, put, delete)
- `bin/save-all-users.sh`: crea 5 usuarios
- `bin/delete-all-users.sh`: borra los 5 usuarios
- `bin/save-and-modify-users.sh`: crea algunos usuarios y los modifica
- `bin/integration-tests-all-servers.sh`: pruebas locas con todos los servers, todos
los tipos de peticiones,...
