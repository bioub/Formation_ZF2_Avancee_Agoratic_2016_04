<?php

namespace Application\Service;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServiceAbstractFactory implements AbstractFactoryInterface
{
    protected $regexp = '/^Application\\\\Service\\\\([a-zA-Z]+)Doctrine$/';

    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return preg_match($this->regexp, $requestedName);
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $em = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $class = $requestedName . 'Service';
        return new $class($em);
    }
}