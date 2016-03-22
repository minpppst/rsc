[![Stories in Ready](https://badge.waffle.io/minpppst/rsc.png?label=ready&title=Ready)](https://waffle.io/minpppst/rsc)
Registro, Seguimiento y Control
============================
Sistema para el registro, seguimiento y control de proyectos y acciones centralizadas.


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

Coming soon...


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=rsc',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```