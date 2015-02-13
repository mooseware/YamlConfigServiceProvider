<?php

namespace Mooseware\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

class YamlConfigServiceProvider implements ServiceProviderInterface
{
    protected $environment = "dev";
    protected $configPath = "";

    public function __construct(Array $params) {
        if ( isset($params['envVarName']) and ! empty($_SERVER[$params['envVarName']]))
            $this->environment = $_SERVER[$params['envVarName']];

        if (isset($params['configPath']))
            $this->configPath = realpath($params['configPath']);
    }

    public function register(Application $app) {
        die(var_dump($this->environment));
        die(var_dump($this->configPath));
        // @todo: find file based on app configuration
        // @todo: read file

    }

    public function boot (Application $app) {
    }

}