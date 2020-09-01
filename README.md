# Deberes del curso sobre DriftPHP, CQRS y Event sourcing

## Cómo ejecutar el proyecto

1. Instalar dependencias
2. Levantar la infraestructura
3. Crear base de datos y tabla `users` en MySQL y exchange en RabbitMQ
4. Levantar servidores

### Instalar dependencias

`composer install` o `composer update`

Hay un script, `bin/composer.sh` que te ayuda si ejecutas todo en contenedores docker.

### Infraestructura

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

Seguramente, tendrás que modificar al menos un parámetro de configuración. En el archivo
`Drift/config/services.yml`, deberás modificar `parameters/host_address`, al inicio del
archivo:

```yaml
parameters:
  # ...
  host_address: 192.168.1.143

#...
```

Como valor debes poner una dirección IP que sea accesible desde los contenedores docker y
desde la máquina que ejecuta los contenedores. La dirección privada de tu red local debería
ser válido. Esta dirección IP se utiliza por ejemplo para conectar a la base de datos.
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
