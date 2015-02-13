<?php

namespace Mooseware\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

class YamlConfigServiceProvider implements ServiceProviderInterface
{
    protected
        $environment = "dev",
        $configPath = "",
        $configFile = "";

    public function __construct(Array $params) {
        if ( isset($params['envVarName']) and ! empty($_SERVER[$params['envVarName']]))
            $this->environment = $_SERVER[$params['envVarName']];

        if (isset($params['configPath']))
            $this->configPath = realpath($params['configPath']);

        $this->configFile = $this->configPath . DIRECTORY_SEPARATOR . "config." . $this->environment . ".yaml";
    }

    public function register(Application $app) {
        $config = $this->_parseConfigFile();

        if (is_array($config)) {
            if (isset($app['config']) and is_array($app['config'])) {
                $app['config'] = array_replace_recursive($app['config'], $config);
            } else {
                $app['config'] = $config;
            }
        }
    }

    public function boot(Application $app) {
    }

    private function _parseConfigFile() {
        if ( ! file_exists($this->configFile))
            throw new \InvalidArgumentException(sprintf("Config file '%s' was not found in '%'!", $this->configFile, $this->configPath));

        return Yaml::parse($this->configFile);
    }

}