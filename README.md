[![Stories in Ready](https://badge.waffle.io/minpppst/rsc.png?label=ready&title=Ready)](https://waffle.io/minpppst/rsc)
[![Stories in In Progress](https://badge.waffle.io/minpppst/rsc.png?label=in%20progress&title=In%20Progress)](https://waffle.io/minpppst/rsc)
Registro, Seguimiento y Control
============================
Sistema para el registro, seguimiento y control de proyectos y acciones centralizadas.


ESTRUCTURA DE LOS DIRECTORIOS
-------------------

```
      common
          config/              contains shared configurations
          mail/                contains view files for e-mails
          models/              contains model classes used in both backend and frontend
      console
          config/              contains console configurations
          controllers/         contains console controllers (commands)
          migrations/          contains database migrations
          models/              contains console-specific model classes
          runtime/             contains files generated during runtime
      backend
          assets/              contains application assets such as JavaScript and CSS
          config/              contains backend configurations
          controllers/         contains Web controller classes
          models/              contains backend-specific model classes
          runtime/             contains files generated during runtime
          views/               contains view files for the Web application
          web/                 contains the entry script and Web resources
      frontend
          assets/              contains application assets such as JavaScript and CSS
          config/              contains frontend configurations
          controllers/         contains Web controller classes
          models/              contains frontend-specific model classes
          runtime/             contains files generated during runtime
          views/               contains view files for the Web application
          web/                 contains the entry script and Web resources
          widgets/             contains frontend widgets
      vendor/                  contains dependent 3rd-party packages
      environments/            contains environment-based overrides
      tests                    contains various tests for the advanced application
          codeception/         contains tests developed with Codeception PHP Testing Framework
```


REQUERIMIENTOS
------------

El requerimiento mínimo para este proyecto es un servidor Web que soporte PHP 5.4.0.


INSTALACIÓN
------------

Próximamente...


CONFIGURACIÓN
-------------

### Base de Datos

Editar el archivo `common/config/main-local.php` con datos reales, por ejemplo:

```php
return [
  'components' => [
    'db' => [
      'class' => 'yii\db\Connection',
      'dsn' => 'mysql:host=localhost;dbname=rsc',
      'username' => 'root',
      'password' => '1234',
      'charset' => 'utf8',
    ]
  ]    
];
```
