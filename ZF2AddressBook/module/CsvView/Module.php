<?php

namespace CsvView;


use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Stdlib\ArrayUtils;

class Module implements ConfigProviderInterface //, AutoloaderProviderInterface
{
    public function getConfig()
    {
        $configContent = scandir(__DIR__ . '/config/');
        $configFiles = array_filter($configContent, function($filename) {
           return preg_match("/\\.config\\.php$/", $filename);
        });

        $config = array();

        foreach ($configFiles as $configFile) {
            $config = ArrayUtils::merge($config, include __DIR__ . '/config/' . $configFile);
        }

        return $config;
    }

//    public function getAutoloaderConfig()
//    {
//        return array(
//            'Zend\Loader\StandardAutoloader' => array(
//                'namespaces' => array(
//                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
//                ),
//            ),
//        );
//    }
}