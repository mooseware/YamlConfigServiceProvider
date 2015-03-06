# YamlConfigServiceProvider
Silex Service provider for YAML configuration files

Installation
--------------
Simply add the following line to your composer.json:

    "require": {
        ...
        "mooseware/yaml-config-service-provider": "1.*",
        ...
    }
    
Then run `composer update` at your console.


Usage
--------------
Register the provider with your application.

    $app->register(new Mooseware\Silex\YamlConfigServiceProvider());

The provider assumes some parameters such as the environment variable name and the config path. By default the variable name (that you may have set through .htaccess) is `APP_ENV`. The default config file path is `</path/to/your/application>/config/`. You can override those settings by passing the changes to the providers constructor:

    $app->register(new Mooseware\Silex\YamlConfigServiceProvider([
        'envVarName' => 'YOUR_ENV_NAME',
        'configPath' => __DIR__ . '/path/to/your/configfolder',
    ]));
  
However, the config file names need to have the following pattern:

    config.<env>.yml

Finally, after registering the provider, you can access the configuration attributes through `$app['config']`.


Example
---------------
**app/config/config.dev.yml**

    database:
        host: localhost
        user: myuser
        password: mypassword

**web/index.php**

    <?php
        require_once __DIR__.'/../vendor/autoload.php';

        $app = new Silex\Application();

        $app->register(new Mooseware\Silex\YamlConfigServiceProvider([
            'envVarName' => 'MY_APP_ENV',
            'configPath' => __DIR__ . '/../app/config',
        ]));

        die(var_dump($app['config']));

will show you

    array (size=1)
      'database' => 
        array (size=3)
          'host' => string 'localhost' (length=9)
          'user' => string 'myuser' (length=6)
          'password' => string 'mypassword' (length=10)
          
          
          
Any improvements are welcome!
