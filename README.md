Bitcoin profit calculator

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      components/             contains application configurations
      config/             contains application configurations
      controllers/        contains Web controller classes
      models/             contains model classes
      runtime/            contains files generated during runtime
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

You can install this project template using the following commands:

~~~
git clone git@github.com:Tairesh/test-coin.git
cd test-coin
composer install
~~~

Now you should be able to access the application through the following URL, assuming `test-coin` is the directory
directly under the Web root.

~~~
http://localhost/test-coin/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => '\yii\mongodb\Connection',
    'dsn' => 'mongodb://username:password@localhost:27017/test-coin',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.
